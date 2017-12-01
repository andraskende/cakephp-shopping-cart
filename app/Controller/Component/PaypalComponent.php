<?php
App::uses('Component', 'Controller');
class PaypalComponent extends Component {

////////////////////////////////////////////////////////////

    public $components = array('Session');

////////////////////////////////////////////////////////////

    public $controller;

////////////////////////////////////////////////////////////

    public $API_Endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
    public $PAYPAL_URL = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=';

//////////////////////////////////////////////////

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, array_merge($this->settings, (array)$settings));
    }

////////////////////////////////////////////////////////////

    public function initialize(Controller $controller) {

        $this->API_UserName = Configure::read('Settings.PAYPAL_API_USERNAME');
        $this->API_Password = Configure::read('Settings.PAYPAL_API_PASSWORD');
        $this->API_Signature = Configure::read('Settings.PAYPAL_API_SIGNATURE');
        $this->version = 64;
        $this->SandboxFlag = true;
        $this->returnURL = Configure::read('Settings.WEBSITE') . '/shop/step2';
        $this->cancelURL = Configure::read('Settings.WEBSITE') . '/shop/cart';
        $this->paymentType = 'Sale';
        $this->currencyCodeType = 'USD';
        $this->sBNCode = 'PP-ECWizard';
    }

////////////////////////////////////////////////////////////

    public function startup(Controller $controller)  {
    }

////////////////////////////////////////////////////////////

    public function step1($shop) {
        $resArray = $this->CallShortcutExpressCheckout($shop);
        $ack = strtoupper($resArray['ACK']);
        if($ack=='SUCCESS' || $ack=='SUCCESSWITHWARNING') {
            return $this->controller->redirect($this->PAYPAL_URL . $resArray['TOKEN']);
        }
    }

////////////////////////////////////////////////////////////

    public function CallShortcutExpressCheckout($shop) {

        $nvpstr = '&PAYMENTREQUEST_0_AMT='. $shop['Order']['total'];
        $nvpstr .= '&PAYMENTREQUEST_0_PAYMENTACTION=' . $this->paymentType;
        $nvpstr .= '&RETURNURL=' . $this->returnURL;
        $nvpstr .= '&CANCELURL=' . $this->cancelURL;
        $nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . $this->currencyCodeType;

        $item = 0;
        foreach ($shop['OrderItem'] as $key => $value) {
            $nvpstr .= '&L_PAYMENTREQUEST_0_NAME' . $item . '='. urlencode($value['name']).'';
            $nvpstr .= '&L_PAYMENTREQUEST_0_AMT' . $item . '='.$value['price'].'';
            $nvpstr .= '&L_PAYMENTREQUEST_0_QTY' . $item . '='.$value['quantity'].'';
            $item++;
        }

        $this->Session->write('Shop.Paypal.currencyCodeType', $this->currencyCodeType);
        $this->Session->write('Shop.Paypal.PaymentType', $this->paymentType);
        $resArray = $this->hash_call('SetExpressCheckout', $nvpstr);
        $ack = strtoupper($resArray['ACK']);
        if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
            $token = urldecode($resArray['TOKEN']);
            $this->Session->write('Shop.Paypal.TOKEN', $token);
        }
        return $resArray;
    }

////////////////////////////////////////////////////////////

    public function GetShippingDetails($token) {
        $resArray = $this->hash_call('GetExpressCheckoutDetails', '&TOKEN=' . $token);
        $ack = strtoupper($resArray['ACK']);
        if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
            $this->Session->write('Shop.Paypal.payer_id', $resArray['PAYERID']);
        }
        return $resArray;
    }

////////////////////////////////////////////////////////////

    public function ConfirmPayment($FinalPaymentAmt) {
        $paypal = $this->Session->read('Shop.Paypal');
        $token = urlencode($paypal['TOKEN']);
        $paymentType = urlencode($paypal['PaymentType']);
        $currencyCodeType = urlencode($paypal['currencyCodeType']);
        $payerID = urlencode($paypal['payer_id']);
        $serverName = urlencode($_SERVER['SERVER_NAME']);
        $nvpstr = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTREQUEST_0_PAYMENTACTION=' . $paymentType . '&PAYMENTREQUEST_0_AMT=' . $FinalPaymentAmt;
        $nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . $currencyCodeType . '&IPADDRESS=' . $serverName;

        $resArray = $this->hash_call('DoExpressCheckoutPayment', $nvpstr);

        $ack = strtoupper($resArray['ACK']);
        return $resArray;
    }

////////////////////////////////////////////////////////////

    public function hash_call($methodName, $nvpStr) {

        $nvpreq  = 'METHOD=' . urlencode($methodName) . '&VERSION=' . urlencode($this->version) . '&PWD=' . urlencode($this->API_Password);
        $nvpreq .= '&USER=' . urlencode($this->API_UserName) . '&SIGNATURE=' . urlencode($this->API_Signature) . $nvpStr . '&BUTTONSOURCE=' . urlencode($this->sBNCode);

        App::uses('HttpSocket', 'Network/Http');
        $httpSocket = new HttpSocket();

        $response = $httpSocket->post($this->API_Endpoint, $nvpreq);

        $nvpResArray = $this->deformatNVP($response);

        return $nvpResArray;
    }

////////////////////////////////////////////////////////////

    public function deformatNVP($nvpstr) {
        $intial = 0;
        $nvpArray = array();
        while(strlen($nvpstr)) {
            $keypos= strpos($nvpstr, '=');
            $valuepos = strpos($nvpstr, '&') ? strpos($nvpstr, '&') : strlen($nvpstr);
            $keyval = substr($nvpstr, $intial, $keypos);
            $valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos - 1);
            $nvpArray[urldecode($keyval)] = urldecode($valval);
            $nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
        }
        return $nvpArray;
    }

////////////////////////////////////////////////////////////

}
