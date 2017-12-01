<?php
class UpsComponent extends Component {

////////////////////////////////////////////////////////////

    const LIVE_URL = 'https://www.ups.com/ups.app/xml/Rate';
    const TEST_URL = 'https://wwwcie.ups.com/ups.app/xml/Rate';

    private $url;

    public $defaults = array(
        'ShipperZip' => '94901',
        'ShipperCountry' => 'US',
        'ShipFromZip' => '94901',
        'ShipFromCountry' => 'US',
        'ShipToZip' => '',
        'ShipToCountry' => 'US',

        'ShipperNumber' => '01',
        'PickupType' => '01',
        'PackagingType' => '02',

        'DimensionsUnit' => 'IN',

        'DimensionsLength' => '8',
        'DimensionsHeight' => '8',
        'DimensionsWidth' => '8',

        'WeightUnit' => 'LBS',
        'Weight' => '1',

        'Service' => '03'
    );

////////////////////////////////////////////////////////////

    public function startup(Controller $controller, $options=array()) {

        if(Configure::read('Settings.UPS_MODE') == 'test') {
            $this->url = self::TEST_URL;
        }
        else if (Configure::read('Settings.UPS_MODE') == 'live') {
            $this->url = self::LIVE_URL;
        }

        $this->defaults = array_merge((array)$this->defaults, (array)$options);
    }

////////////////////////////////////////////////////////////

    public function getRate($data = null) {

        if ($data['Weight'] < .1) {
            $data['Weight'] = .1;
        }

        if ($data['Weight'] > 70) {
            $data['Weight'] = 70;
        }

        $xml = $this->buildRequest($data);

        App::uses('HttpSocket', 'Network/Http');
        $httpSocket = new HttpSocket();
        $res = $httpSocket->post($this->url, $xml);

        App::uses('Xml', 'Utility');
        $response = Xml::toArray(Xml::build($res['body']));
        $formattedResponse = $this->formatResponse($response);

        if (!empty($formattedResponse)) {
            return $formattedResponse;
        }
        return false;

    }

////////////////////////////////////////////////////////////

    protected function buildRequest($data=array()) {

        $this->defaults = array_merge((array)$this->defaults, (array)$data);

        if ($this->defaults['DimensionsLength'] < .1) { $this->defaults['DimensionsLength'] = 1; }
        if ($this->defaults['DimensionsHeight'] < .1) { $this->defaults['DimensionsHeight'] = 1; }
        if ($this->defaults['DimensionsWidth'] < .1) { $this->defaults['DimensionsWidth'] = 1; }

        $xml = '<?xml version="1.0"?>
        <AccessRequest xml:lang="en-US">
            <AccessLicenseNumber>' . Configure::read('Settings.UPS_ACCESSKEY') . '</AccessLicenseNumber>
            <UserId>' . Configure::read('Settings.UPS_USERID') . '</UserId>
            <Password>' . Configure::read('Settings.UPS_PASSWORD') . '</Password>
        </AccessRequest>
        <?xml version="1.0"?>
        <RatingServiceSelectionRequest xml:lang="en-US">
            <Request>
                <TransactionReference>
                    <CustomerContext>Bare Bones Rate Request</CustomerContext>
                    <XpciVersion>1.0001</XpciVersion>
                </TransactionReference>
                <RequestAction>Rate</RequestAction>
                <RequestOption>shop</RequestOption>
            </Request>
            <PickupType>
                <Code>' . $this->defaults['PickupType'] . '</Code>
            </PickupType>
            <Shipment>
                <Shipper>
                    <Address>
                        <PostalCode>' . $this->defaults['ShipperZip'] . '</PostalCode>
                        <CountryCode>' . $this->defaults['ShipperCountry'] . '</CountryCode>
                    </Address>
                    <ShipperNumber>' . $this->defaults['ShipperNumber'] . '</ShipperNumber>
                </Shipper>
                <ShipTo>
                    <Address>
                        <PostalCode>' . $this->defaults['ShipToZip'] . '</PostalCode>
                        <CountryCode>' . $this->defaults['ShipToCountry'] . '</CountryCode>
                        <ResidentialAddressIndicator/>
                    </Address>
                </ShipTo>
                <ShipFrom>
                    <Address>
                        <PostalCode>' . $this->defaults['ShipFromZip'] . '</PostalCode>
                        <CountryCode>' . $this->defaults['ShipFromCountry'] . '</CountryCode>
                    </Address>
                </ShipFrom>
                <Package>
                    <PackagingType>
                        <Code>' . $this->defaults['PackagingType'] . '</Code>
                    </PackagingType>
                    <Dimensions>
                        <UnitOfMeasurement>
                            <Code>' . $this->defaults['DimensionsUnit'] . '</Code>
                        </UnitOfMeasurement>
                        <Length>' . $this->defaults['DimensionsLength'] . '</Length>
                        <Width>' . $this->defaults['DimensionsWidth'] . '</Width>
                        <Height>' . $this->defaults['DimensionsHeight'] . '</Height>
                    </Dimensions>
                    <PackageWeight>
                        <UnitOfMeasurement>
                            <Code>' . $this->defaults['WeightUnit'] . '</Code>
                        </UnitOfMeasurement>
                        <Weight>' . number_format($this->defaults['Weight'], 2, '.', '') . '</Weight>
                    </PackageWeight>
                </Package>
            </Shipment>
        </RatingServiceSelectionRequest>';

        return $xml;
    }

////////////////////////////////////////////////////////////

    protected function formatResponse($response) {

        $service_code = array(
            '01' => 'UPS Next Day Air',
            '02' => 'UPS 2nd Day Air',
            '03' => 'UPS Ground',
            '07' => 'UPS Worldwide Express',
            '08' => 'UPS Worldwide Expedited',
            '11' => 'UPS Standard',
            '12' => 'UPS 3 Day Select',
            '13' => 'UPS Next Day Air Saver',
            '14' => 'UPS Next Day Air Early A.M.',
            '54' => 'UPS Worldwide Express Plus',
            '59' => 'UPS 2nd Day Air A.M.',
        );

        $service_enabled = array(
            '01',
            '02',
            '12',
            '03',
        );

        $results = array();
        $i = 0;

        foreach($response['RatingServiceSelectionResponse']['RatedShipment'] as $result) {
            $code = $result['Service']['Code'];
            if(in_array($code, $service_enabled)) {
                $results[$i]['ServiceCode'] = $code;
                $results[$i]['ServiceName'] = $service_code[$code];
                $results[$i]['TotalCharges'] = $result['TotalCharges']['MonetaryValue'];
                $i++;
            }
        }

        $results = Hash::sort($results, '{n}.TotalCharges', 'ASC');

        return $results;

    }

////////////////////////////////////////////////////////////

}
