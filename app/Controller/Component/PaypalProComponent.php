<?php
class PaypalProComponent extends Component {

////////////////////////////////////////////////////////////

    public $paypal_username = null;
    public $paypal_password = null;
    public $paypal_signature = null;

    private $paypal_endpoint = 'https://api-3t.paypal.com/nvp';
    private $paypal_endpoint_test = 'https://api-3t.sandbox.paypal.com/nvp';

    public $amount = null;

    public $ipAddress = '';

    public $creditCardType = '';
    public $creditCardNumber = '';
    public $creditCardExpires = '';
    public $creditCardCvv = '';

    public $customerFirstName = '';
    public $customerLastName = '';
    public $customerEmail = '';

    public $billingAddress1 = '';
    public $billingAddress2 = '';
    public $billingCity = '';
    public $billingState = '';
    public $billingCountryCode = '';
    public $billingZip = '';

    protected $_controller = null;

////////////////////////////////////////////////////////////

    public function __construct() {
    }

////////////////////////////////////////////////////////////

    public function initialize(Controller $controller) {

        $this->_controller = $controller;

        $this->ipAddress = $_SERVER['REMOTE_ADDR'];

        $this->paypal_username = Configure::read('Settings.PAYPAL_USERNAME');
        $this->paypal_password = Configure::read('Settings.PAYPAL_PASSWORD');
        $this->paypal_signature = Configure::read('Settings.PAYPAL_SIGNATURE');

        if(Configure::read('Settings.PAYPAL_MODE') == 'test') {
            $this->paypal_endpoint = $this->paypal_endpoint_test;
        }

    }

////////////////////////////////////////////////////////////

    public function doDirectPayment() {

        $doDirectPaymentNvp = array(
            'METHOD' => 'DoDirectPayment',
            'VERSION' => '53.0',
            'PAYMENTACTION' => 'Sale',
            'IPADDRESS' => $this->ipAddress,
            'RETURNFMFDETAILS' => 1,

            'ACCT' => $this->creditCardNumber,
            'EXPDATE' => $this->creditCardExpires,
            'CVV2' => $this->creditCardCvv,
            'CREDITCARDTYPE' => $this->creditCardType,

            'FIRSTNAME' => $this->customerFirstName,
            'LASTNAME' => $this->customerLastName,
            'EMAIL' => $this->customerEmail,

            'STREET' => $this->billingAddress1,
            'STREET2' => $this->billingAddress2,
            'CITY' => $this->billingCity,
            'STATE' => $this->billingState,
            'COUNTRYCODE' => $this->billingCountryCode,
            'ZIP' => $this->billingZip,

            'AMT' => $this->amount,
            'CURRENCYCODE' => 'USD',

            'USER' => $this->paypal_username,
            'PWD' => $this->paypal_password,
            'SIGNATURE' => $this->paypal_signature,
        );

        App::uses('HttpSocket', 'Network/Http');
        $httpSocket = new HttpSocket();

        $response = $httpSocket->post($this->paypal_endpoint, $doDirectPaymentNvp);

        parse_str($response , $parsed);

        if(array_key_exists('ACK', $parsed) && $parsed['ACK'] == 'Success') {
            return $parsed;
        }
        elseif(array_key_exists('ACK', $parsed) && array_key_exists('L_LONGMESSAGE0', $parsed) && $parsed['ACK'] != 'Success') {
            $this->log($parsed, 'paypal');
            throw new Exception($parsed['ACK'] . ' : ' . $parsed['L_LONGMESSAGE0']);
        }
        elseif(array_key_exists('ACK', $parsed) && array_key_exists('L_ERRORCODE0', $parsed) && $parsed['ACK'] != 'Success') {
            $this->log($parsed, 'paypal');
            throw new Exception($parsed['ACK'] . ' : ' . $parsed['L_ERRORCODE0']);
        }
        else {
            $this->log($parsed, 'paypal');
            throw new Exception('There is a problem with the payment gateway. Please try again later.');
        }

    }

////////////////////////////////////////////////////////////

}

