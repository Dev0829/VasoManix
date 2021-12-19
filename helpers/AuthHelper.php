<?php

namespace app\helpers;

use app\models\OrderItems;
use app\models\Orders;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use app\models\AuthGateways;
use app\models\User;

class AuthHelper
{

    static public function getCustomParameters($paramName) {

        return isset(\Yii::$app->params [$paramName]) ? \Yii::$app->params [$paramName] : '';
    }

    public static function getClientIp() {

        $ipAddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipAddress = $_SERVER['HTTP_CLIENT_IP']; else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR']; else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED']; else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR']; else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_FORWARDED']; else if (isset($_SERVER['REMOTE_ADDR']))
            $ipAddress = $_SERVER['REMOTE_ADDR']; else
            $ipAddress = 'UNKNOWN';

        return $ipAddress;
    }

    static public function getAuthorizeMerchant($gateway) {

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();

        $loginId        = $gateway->loginId;
        $transactionKey = $gateway->transactionKey;

        $merchantAuthentication->setName($loginId);
        $merchantAuthentication->setTransactionKey($transactionKey);

        return $merchantAuthentication;
    }

    static public function getAuthorizeMode() {

        if (UtilityHelper::getCustomParameters('authorize.mode') == 'live') {
            return \net\authorize\api\constants\ANetEnvironment::PRODUCTION;
        }

        return \net\authorize\api\constants\ANetEnvironment::SANDBOX;
    }

    static public function getWeightedGateway($cardType = FALSE,
                                              $is_gateway = FALSE) {

        if ($is_gateway !== FALSE) {
            return AuthGateways::getGatewayByCampaign($cardType);
        } else {
            return AuthGateways::getGateway($cardType);
        }

    }

    static public function doPayment($orderId, $is_gateway = FALSE) {

        $order   = Orders::findOne($orderId);

        $gateway = self::getWeightedGateway($order->creditCardType,
                                            $is_gateway);

        if ($gateway === FALSE) {
            $order->status = Orders::STATUS_FAILED;
            $order->save();

            return;
        }

        $order->mid = $gateway->mid;
        $order->save();

        // Common setup for API credentials
        $merchantAuthentication = self::getAuthorizeMerchant($gateway);
        $refId                  = 'ORDER # ' . $order->id;

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($order->cardNumber);

        $expiration = explode('/',
                              $order->expirationDate);

        $expirationDate = '20' . $expiration[1] . '-' . $expiration[0];

        $creditCard->setExpirationDate($expirationDate);


        // Create order information
        $orderInfo = new AnetAPI\OrderType();
        $orderInfo->setInvoiceNumber($refId);
        $userItems = $order->getItems();

        $elems     = [];
        foreach ($userItems as $item) {
            $suffix = '';
            if ($item->productId > 0) {
                $suffix = ' (' . $item->productId . ')';
            }

            //$elems[] = $item->name . $suffix;
            $elems[] = $item->productId;
        }
        $description = implode(', ',
                               $elems);

        $orderInfo->setDescription($description);

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($order->firstName);
        $customerAddress->setLastName($order->lastName);
        //$customerAddress->setCompany("Souveniropolis");
        $customerAddress->setEmail($order->email);
        $customerAddress->setPhoneNumber($order->phone);
        $customerAddress->setAddress($order->shippingAddress1);
        $customerAddress->setCity($order->shippingCity);
        $customerAddress->setState($order->shippingState);
        $customerAddress->setZip($order->shippingZip);
        $customerAddress->setCountry($order->shippingCountry);


        if (isset($order->billingSameAsShipping) && $order->billingSameAsShipping == 0) {

            // Set the customer's Shipping To address
            $customerAddress = new AnetAPI\CustomerAddressType();
            $customerAddress->setFirstName($order->firstName);
            $customerAddress->setLastName($order->lastName);
            //$customerAddress->setCompany("Souveniropolis");
            $customerAddress->setAddress($order->shippingAddress1);
            $customerAddress->setCity($order->shippingCity);
            $customerAddress->setState($order->shippingState);
            $customerAddress->setZip($order->shippingZip);
            $customerAddress->setCountry($order->shippingCountry);

            // Set the customer's billing To address
            $billTo = new AnetAPI\CustomerAddressType();
            $billTo->setFirstName($order->firstName);
            $billTo->setLastName($order->lastName);
            $billTo->setEmail($order->email);
            $billTo->setPhoneNumber($order->phone);
            $billTo->setAddress($order->billingAddress1);
            $billTo->setCity($order->billingCity);
            $billTo->setState($order->billingState);
            $billTo->setZip($order->billingZip);
            $billTo->setCountry($order->billingCountry);
        } else {

            // Set the customer's Bill To address
            $customerAddress = new AnetAPI\CustomerAddressType();
            $customerAddress->setFirstName($order->firstName);
            $customerAddress->setLastName($order->lastName);
            //$customerAddress->setCompany("Souveniropolis");
            $customerAddress->setEmail($order->email);
            $customerAddress->setPhoneNumber($order->phone);
            $customerAddress->setAddress($order->shippingAddress1);
            $customerAddress->setCity($order->shippingCity);
            $customerAddress->setState($order->shippingState);
            $customerAddress->setZip($order->shippingZip);
            $customerAddress->setCountry($order->shippingCountry);
        }


        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        //$customerData->setId("99999456654");
        $customerData->setEmail($order->email);


        // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");


        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($order->amount);
        $transactionRequestType->setPayment($paymentOne);


        $transactionRequestType->setOrder($orderInfo);
        if (isset($billTo)) {
            $transactionRequestType->setBillTo($billTo);

            $transactionRequestType->setShipTo($customerAddress);
        } else {
            $transactionRequestType->setBillTo($customerAddress);
        }

        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);

  
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);

        $response          = $controller->executeWithApiResponse(self::getAuthorizeMode());
        $order->campaignId = $gateway->campaignId;
        

        if ($response != NULL) {



            if ($response->getMessages()->getResultCode() == "Ok") {

                $tresponse = $response->getTransactionResponse();

                if ($tresponse->getAvsResultCode() != NULL) {
                    $order->avsCode = $tresponse->getAvsResultCode();
                }

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $order->status            = Orders::STATUS_CONFIRMED;
                    $order->transactionNumber = $tresponse->getTransId();
                    $order->authCode          = $tresponse->getAuthCode();

                    $order->save();
                }else{
                    $order->status       = Orders::STATUS_FAILED;
                    $order->errorMessage = "Transaction Failed | ";
                    if ($tresponse->getErrors() != null) {

                        $order->errorMessage .= "[".$tresponse->getErrors()[0]->getErrorCode()."]";
                        $order->errorMessage .= " Error Message:" . $tresponse->getErrors()[0]->getErrorText();

                    }
                    $order->save();

                }
            }else{
                $order->status       = Orders::STATUS_FAILED;
                $order->errorMessage = "Transaction Failed NOT-OK | ";
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $order->errorMessage .= "[" . $tresponse->getErrors()[0]->getErrorCode() . "]";
                    $order->errorMessage .= " Error Message : " . $tresponse->getErrors()[0]->getErrorText();
                } else {
                    $order->errorMessage .=  "[". $response->getMessages()->getMessage()[0]->getCode() .  "]";
                    $order->errorMessage .= " Error Message : " . $response->getMessages()->getMessage()[0]->getText();
                }
                $order->save();

            }




        } else {
            //echo  "Charge Credit Card Null response returned";
            $order->errorMessage = 'Charge Credit Card Null response returned';
            $order->status       = Orders::STATUS_FAILED;
            $order->save();
        }

    }


    static public function validateData($data, $regex = '', $count = '') {

        if ($data) {
            if (!isset($regex) || $regex == '') {
                $regex = 'a-zA-Z0-9 \s';
            }
            if (!isset($count) || $count == '') {
                $count = '*';
            } else {
                $count = '{' . $count . '}';
            }
            $regex = '[' . $regex . ']';
            $preg  = '/^' . $regex . $count . '$/';

            if (preg_match($preg, $data)) {
                return $data;
            } else {
                return FALSE;
            }

        } else {
            return FALSE;
        }
    }

    static public function checkRequest($request = []) {

        /*
         * STRUCTURE OF REQUIRED
         *
         *
         $array = ['lastName' => $lastName,
         'phone'    => $phone,
         'email'    => $email,

         'shippingAddress1' => $shippingAddress1,
         'shippingZip'      => $shippingZip,
         'shippingCity'     => $shippingCity,
         'shippingCountry'  => $shippingCountry,
         'shippingState'    => $shippingState,

         'shippingId' => $shippingId,

         'billingSameAsShipping' => $billingSameAsShipping,

         'billingAddress1' => $billingAddress1,
         'billingZip'      => $billingZip,
         'billingCity'     => $billingCity,
         'billingCountry'  => $billingCountry,
         'billingState'    => $billingState,

         'creditCardType' => $creditCardType,

         ];

         */

        /**
         * PERSONAL info req
         */
        $firstName          = isset($request['firstName']) ? $request['firstName'] : FALSE; //A - Max 64 Characters
        $array['firstName'] = self::validateData($firstName,
                                                 'a-zA-Z \s',
                                                 '2,64');

        $lastName          = isset($request['lastName']) ? $request['lastName'] : FALSE; //A - Max 64 Characters
        $array['lastName'] = self::validateData($lastName, 'a-zA-Z \s', '2,64');

        $email = isset($request['email']) ? $request['email'] : FALSE;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = FALSE;
        }
        $array['email'] = $email;

        $phone          = isset($request['phone']) ? $request['phone'] : FALSE; //N - Max 18 Characters
        $array['phone'] = self::validateData($phone, '0-9', '4,18');


        /**
         * SHIPPING info req
         */
        $shippingAddress1          = isset($request['shippingAddress1']) ? $request['shippingAddress1'] : FALSE; //A - Max 64 Characters
        $array['shippingAddress1'] = self::validateData($shippingAddress1,
                                                        '',
                                                        '2,60');

        $shippingZip          = isset($request['shippingZip']) ? $request['shippingZip'] : FALSE; //A - Max 10 Characters
        $array['shippingZip'] = self::validateData($shippingZip,
                                                   '0-9a-zA-Z  \s',
                                                   '4,16');

        $shippingCity          = isset($request['shippingCity']) ? $request['shippingCity'] : FALSE; //A - Max 32 Characters
        $array['shippingCity'] = self::validateData($shippingCity, '', '2,32');

        $shippingCountry          = isset($request['shippingCountry']) ? $request['shippingCountry'] : FALSE; // 2 character country value*. Required - Customer's shipping country
        $array['shippingCountry'] = self::validateData($shippingCountry,
                                                       '',
                                                       '2');

        $shippingState          = isset($request['shippingState']) ? $request['shippingState'] : FALSE; //A - Max 32 Characters ##For US states use the 2 character abbreviation;
        $array['shippingState'] = self::validateData($shippingState,
                                                     '',
                                                     '2,32');


        /**
         * billingSameAsShipping req
         */
        $billingSameAsShipping = isset($request['billingSameAsShipping']) ? $request['billingSameAsShipping'] : 'YES';
        if ($billingSameAsShipping) {
            $billingSameAsShipping          = strtolower(self::validateData($billingSameAsShipping,
                                                                            'a-zA-Z',
                                                                            '0,3'));
            $array['billingSameAsShipping'] = $billingSameAsShipping;
        }
        // A - YES or NO (case insensitive)
        // If left blank, will default to yes and will copy all the shipping columns into the billing columns.

        if ($billingSameAsShipping == 'yes') {
            /**
             * BILLING info A - YES
             */
            $billingAddress1 = $shippingAddress1;
            $billingZip      = $shippingZip;
            $billingCity     = $shippingCity;
            $billingCountry  = $shippingCountry;
            $billingState    = $shippingState;
        } else {

            /**
             * BILLING info A - NO
             */
            $billingAddress1 = isset($request['billingAddress1']) ? $request['billingAddress1'] : FALSE;
            $billingAddress1 = self::validateData($billingAddress1, '', '2,64');

            $billingZip = isset($request['billingZip']) ? $request['billingZip'] : FALSE;
            $billingZip = self::validateData($billingZip, '0-9a-zA-Z', '4,10');

            $billingCity = isset($request['billingCity']) ? $request['billingCity'] : FALSE;
            $billingCity = self::validateData($billingCity, '', '2,32');

            $billingCountry = isset($request['billingCountry']) ? $request['billingCountry'] : FALSE;
            $billingCountry = self::validateData($billingCountry, '', '2');

            $billingState = isset($request['billingState']) ? $request['billingState'] : FALSE;
            $billingState = self::validateData($billingState, '', '2,32');
        } // Billing properties

        $array['billingAddress1'] = $billingAddress1;
        $array['billingZip']      = $billingZip;
        $array['billingCity']     = $billingCity;
        $array['billingCountry']  = $billingCountry;
        $array['billingState']    = $billingState;
        /**
         * PAYMENT TYPE req*
         */
        $creditCardType          = isset($request['creditCardType']) ? $request['creditCardType'] : FALSE;
        $array['creditCardType'] = self::validateData($creditCardType,
                                                      'a-zA-Z \_ ',
                                                      '4,12');
        /**
         * Credit Card types
         *
         *
         * amex, visa, master, discover, checking,
         * offline, solo, maestro, switch, boleto,
         * paypal, diners, hipercard, aura, eft_germany,
         * giro, amazon, icepay, bitcoin_pg, eurodebit, sepa
         *
         */


        /*
         * Conditional Importing info
         *
         *
         * If payment method is paypal
         * and if is there is already sent order and we awaiting token
        */
        if ($creditCardType !== 'paypal') {

            $creditCardNumber = isset($request['creditCardNumber']) ? $request['creditCardNumber'] : FALSE; // N - Max 20 digits
            $creditCardNumber = self::validateData($creditCardNumber,
                                                   '0-9',
                                                   '8,20');

            $fields_expmonth = isset($request['fields_expmonth']) ? $request['fields_expmonth'] : FALSE; // N - MMYY example ## 0316
            $fields_expmonth = self::validateData($fields_expmonth, '0-9', '2');
            $fields_expyear  = isset($request['fields_expyear']) ? $request['fields_expmonth'] : FALSE; // N - MMYY example ## 0316
            $fields_expyear  = self::validateData($fields_expyear, '0-9', '2');

            $CVV = isset($request['CVV']) ? $request['CVV'] : FALSE; //N - Max 4 digits
            $CVV = self::validateData($CVV, '0-9', '2,4');

            $array['creditCardNumber'] = $creditCardNumber;
            $array['fields_expmonth']  = $fields_expmonth;
            $array['fields_expyear']   = $fields_expyear;
            $array['CVV']              = $CVV;
        } elseif (isset($request['alt_pay_token']) && isset($request['alt_pay_payer_id'])) {
            $array['alt_pay_token']      = $request['alt_pay_token'];
            $array['alt_pay_payer_id']   = $request['alt_pay_payer_id'];
            $array['alt_pay_return_url'] = 'https://return.dummy.url';
        }

        /*
         * If there is Errors put it in $errorMsg
         *
         * foreach FALSE make a new line with error message
         * $errorMsg = @string
         *
         */
        $errorMsg = '';

        foreach ($array as $key => $value) {
            if ($value == FALSE) {
                $errorMsg .= 'Error(s) was found. Invalid  <b>' . $key . '</b><br>';
            }
        }

        $errorMsg = trim($errorMsg);

        if (!empty($errorMsg)) {
            return $errorMsg;
        } else {
            return $array;
        }
    }
}


