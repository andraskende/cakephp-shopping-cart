<?php

require_once ("paypalfunctions.php");

if ( $PaymentOption == "PayPal")
{
        // ==================================
        // PayPal Express Checkout Module
        // ==================================

        //'------------------------------------
        //' The paymentAmount is the total value of 
        //' the shopping cart, that was set 
        //' earlier in a session variable 
        //' by the shopping cart page
        //'------------------------------------
        $paymentAmount = $_SESSION["Payment_Amount"];

        //'------------------------------------
        //' When you integrate this code 
        //' set the variables below with 
        //' shipping address details 
        //' entered by the user on the 
        //' Shipping page.
        //'------------------------------------
        $shipToName = "<<ShiptoName>>";
        $shipToStreet = "<<ShipToStreet>>";
        $shipToStreet2 = "<<ShipToStreet2>>"; //Leave it blank if there is no value
        $shipToCity = "<<ShipToCity>>";
        $shipToState = "<<ShipToState>>";
        $shipToCountryCode = "<<ShipToCountryCode>>"; // Please refer to the PayPal country codes in the API documentation
        $shipToZip = "<<ShipToZip>>";
        $phoneNum = "<<PhoneNumber>>";

        //'------------------------------------
        //' The currencyCodeType and paymentType 
        //' are set to the selections made on the Integration Assistant 
        //'------------------------------------
        $currencyCodeType = "USD";
        $paymentType = "Sale";

        //'------------------------------------
        //' The returnURL is the location where buyers return to when a
        //' payment has been succesfully authorized.
        //'
        //' This is set to the value entered on the Integration Assistant 
        //'------------------------------------
        $returnURL = "11";

        //'------------------------------------
        //' The cancelURL is the location buyers are sent to when they hit the
        //' cancel button during authorization of payment during the PayPal flow
        //'
        //' This is set to the value entered on the Integration Assistant 
        //'------------------------------------
        $cancelURL = "22";

        //'------------------------------------
        //' Calls the SetExpressCheckout API call
        //'
        //' The CallMarkExpressCheckout function is defined in the file PayPalFunctions.php,
        //' it is included at the top of this file.
        //'-------------------------------------------------
        $resArray = CallMarkExpressCheckout ($paymentAmount, $currencyCodeType, $paymentType, $returnURL,
                                                                                  $cancelURL, $shipToName, $shipToStreet, $shipToCity, $shipToState,
                                                                                  $shipToCountryCode, $shipToZip, $shipToStreet2, $phoneNum
        );

        $ack = strtoupper($resArray["ACK"]);
        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
        {
                $token = urldecode($resArray["TOKEN"]);
                $_SESSION['reshash']=$token;
                RedirectToPayPal ( $token );
        } 
        else  
        {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
                
                echo "SetExpressCheckout API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
        }
}
else
{
        if ((( $PaymentOption == "Visa") || ( $PaymentOption == "MasterCard") || ($PaymentOption == "Amex") || ($PaymentOption == "Discover"))
                        && ( $PaymentProcessorSelected == "PayPal Direct Payment"))

        //'------------------------------------
        //' The paymentAmount is the total value of 
        //' the shopping cart, that was set 
        //' earlier in a session variable 
        //' by the shopping cart page
        //'------------------------------------
        $paymentAmount = $_SESSION["Payment_Amount"];

        //'------------------------------------
        //' The currencyCodeType and paymentType 
        //' are set to the selections made on the Integration Assistant 
        //'------------------------------------
        $currencyCodeType = "USD";
        $paymentType = "Sale";
        
        //' Set these values based on what was selected by the user on the Billing page Html form
        
        $creditCardType                 = "<<Visa/MasterCard/Amex/Discover>>"; //' Set this to one of the acceptable values (Visa/MasterCard/Amex/Discover) match it to what was selected on your Billing page
        $creditCardNumber                 = "<<CC number>>"; //' Set this to the string entered as the credit card number on the Billing page
        $expDate                                 = "<<Expiry Date>>"; //' Set this to the credit card expiry date entered on the Billing page
        $cvv2                                         = "<<cvv2>>"; //' Set this to the CVV2 string entered on the Billing page 
        $firstName                                 = "<<firstName>>"; //' Set this to the customer's first name that was entered on the Billing page 
        $lastName                                 = "<<lastName>>"; //' Set this to the customer's last name that was entered on the Billing page 
        $street                                 = "<<street>>"; //' Set this to the customer's street address that was entered on the Billing page 
        $city                                         = "<<city>>"; //' Set this to the customer's city that was entered on the Billing page 
        $state                                         = "<<state>>"; //' Set this to the customer's state that was entered on the Billing page 
        $zip                                         = "<<zip>>"; //' Set this to the zip code of the customer's address that was entered on the Billing page 
        $countryCode                         = "<<PayPal Country Code>>"; //' Set this to the PayPal code for the Country of the customer's address that was entered on the Billing page 
        $currencyCode                         = "<<PayPal Currency Code>>"; //' Set this to the PayPal code for the Currency used by the customer 
        
        /*        
        '------------------------------------------------
        ' Calls the DoDirectPayment API call
        '
        ' The DirectPayment function is defined in PayPalFunctions.php included at the top of this file.
        '-------------------------------------------------
        */
        
        $resArray = DirectPayment ( $paymentType, $paymentAmount, $creditCardType, $creditCardNumber,
                                                        $expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip, 
                                                        $countryCode, $currencyCode ); 

        $ack = strtoupper($resArray["ACK"]);
        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
        {
                //Getting transaction ID from API responce. 
                $TransactionID = urldecode($resArray["TRANSACTIONID"]);
                
                echo "Your payment has been successfully processed";
        }
        else
        {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
                
                echo "Direct credit card payment API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
        }
}
?>
