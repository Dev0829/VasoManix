<?php

namespace app\models\Forms;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "orders".
 *
 *
 */
class OrderForm extends Model
{

    public $amount;
    public $productId;
    public $email;
    public $firstName;
    public $lastName;
    public $phone;
    public $shippingAddress1;
    public $shippingZip;
    public $shippingCity;
    public $shippingCountry;
    public $shippingState;
    public $billingSameAsShipping;
    public $payment_processor;
    public $creditCardType;
    public $cardNumber;
    public $cvv;
    public $fields_expmonth;
    public $fields_expyear;
    public $expirationDate;
    public $isExpeditedShipping;
    public $terms;
    public $sms_terms;
    public $pp_subscription_id;
    private $_country = 'US';

    const STATUS_PENDING   = 1;
    const STATUS_CONFIRMED = 2;
    const STATUS_FAILED    = 3;
    const STATUS_CANCELED    = 4;


    /**
     * @return array the validation rules.
     */
    public function rules() {

        return [

            [['productId', 'isExpeditedShipping', 'sms_terms'], 'integer'],
                [['firstName', 'email', 'lastName', 'phone', 'shippingAddress1', 'shippingZip', 'shippingCity', 'shippingCountry', 'shippingState', 'payment_processor'], 'required'],
                [['firstName', 'lastName', 'shippingCity', 'shippingCountry', 'shippingState'], 'match', 'pattern' => '/^[a-zA-Z \s]*$/i'],
                [['shippingAddress1', 'shippingZip'], 'match', 'pattern' => '/^[a-zA-Z0-9 \s]*$/i'],
                [['cardNumber', 'fields_expmonth', 'fields_expyear', 'cvv'], 'match', 'pattern' => '/^[0-9]*$/i'],
                [['phone'], 'match', 'pattern' => '/^[0-9 ()-]*$/i'],


                [['amount'], 'number'],
                [['pp_subscription_id', 'creditCardType', 'expirationDate',], 'string', 'max' => 250],

            ['email', 'email'],

            [['creditCardType','cardNumber', 'fields_expmonth', 'fields_expyear', 'cvv'], 'required', 'when'=> function($model){
                return $model->payment_processor == 'credit_card';
            }, 'whenClient' => 'function (attribute, value) {
        return $(\'[name="OrderForm[payment_processor]"]:checked\').val() === \'credit_card\';}'],



                [['firstName', 'lastName'], 'string', 'max'=>'50'],
                [['email'], 'string', 'max'=>'250'],
                [['shippingAddress1', 'shippingCountry'],'string',  'max'=>'60'],
                [['shippingState', 'shippingCity'],'string',  'max'=>'40'],
                [['shippingZip'], 'string', 'max'=>'20'],

                [['fields_expmonth'], 'validateMonth'],
                [['fields_expyear'], 'validateYear'],
                [['phone'], 'string', 'min'=> '10', 'max'=>'25'],
                [['shippingZip'], 'string', 'min'=> '5', 'max'=>'10'],
                [['cardNumber'], 'string', 'min'=> '13', 'max'=>'16'],
                [['cvv'], 'string', 'min'=> '3', 'max'=>'4'],

            [['terms'], 'required', 'requiredValue' => 1, 'message' => 'Field Required'],

            ];



    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return ['productId'           => 'Product ID',
                'amount'              => 'Amount',
                'email'               => 'Email',
                'firstName'           => 'First Name',
                'lastName'            => 'Last Name',
                'phone'               => 'Phone',
                'shippingAddress1'    => 'Shipping Address',
                'shippingZip'         => 'Shipping Zip',
                'shippingCity'        => 'Shipping City',
                'shippingCountry'     => 'Shipping Country',
                'shippingState'       => 'Shipping State',
                'payment_processor'   => 'Payment Method',
                'cardNumber'          => 'Credit Card #',
                'cvv'                 => 'CVV',
                'fields_expmonth'     => 'Month',
                'fields_expyear'      => 'Year',
                'expirationDate'      => 'Expiration Date',
                'isExpeditedShipping' => 'Is Expedited Shipping',
                'pp_subscription_id' => 'PP Subs Id',
                'terms' => 'Terms',
                'sms_terms' => 'SMS Terms'

        ];
    }

    public function validateMonth($attribute, $params) {
        if ($this->fields_expyear !== NULL && (($this->fields_expyear . $this->fields_expmonth) < date('ym'))) {
            $this->addError('fields_expmonth', 'Invalid Date');
        }
    }

    public function validateYear($attribute, $params) {
        if ($this->fields_expmonth !== NULL && (($this->fields_expyear . $this->fields_expmonth) < date('ym'))) {
            $this->addError('fields_expyear');
        }
    }


    public function checkPaymentProcessor($attribute) {

        $this->addError($attribute, 'Incorrect Payment Processor.');
    }
    public function getPaymentProcessors() {
        return ['credit_card' => 'Pay with Credit Card <img src="/images/credit-cards.png" class="img-fluid ml-3" style="width: 240px">',
                'paypal' => 'Pay with Paypal <img src="/images/paypal.png" class="img-fluid ml-3" style="width: 60px">',];

    }

    public function getMonths() {
        return ['01' => '01',
                '02' => '02',
                '03' => '03',
                '04' => '04',
                '05' => '05',
                '06' => '06',
                '07' => '07',
                '08' => '08',
                '09' => '09',
                '10' => '10',
                '11' => '11',
                '12' => '12',
            ];

    }
    public function getYears() {
        $year       = date('y');
        $yearInt    = $year + 15;
        $optionYear = [];
        for (; $year < $yearInt; $year++) {
            $optionYear[$year] = 20 . $year;
        }

        return $optionYear;

    }

    public function getCountries() {

        # Countries for Checkout
        return ['US' => 'United States',
                'CA' => 'Canada',];



    }

    public function getStates($country = 'US') {
        /*
         * This only works on initial load
         */
        $country = $this->_country;
        $states = ['0' => 'No States Found'];
        if ($country == 'US') {
            $states = ["AL" => 'Alabama',
                       "AK" => 'Alaska',
                       "AZ" => 'Arizona',
                       "AR" => 'Arkansas',
                       "CA" => 'California',
                       "CO" => 'Colorado',
                       "CT" => 'Connecticut',
                       "DC" => 'District of Columbia',
                       "DE" => 'Delaware',
                       "FL" => 'Florida',
                       "GA" => 'Georgia',
                       "HI" => 'Hawaii',
                       "ID" => 'Idaho',
                       "IL" => 'Illinois',
                       "IN" => 'Indiana',
                       "IA" => 'Iowa',
                       "KS" => 'Kansas',
                       "KY" => 'Kentucky',
                       "LA" => 'Louisiana',
                       "ME" => 'Maine',
                       "MD" => 'Maryland',
                       "MA" => 'Massachusetts',
                       "MI" => 'Michigan',
                       "MN" => 'Minnesota',
                       "MS" => 'Mississippi',
                       "MO" => 'Missouri',
                       "MT" => 'Montana',
                       "NE" => 'Nebraska',
                       "NV" => 'Nevada',
                       "NH" => 'New Hampshire',
                       "NJ" => 'New Jersey',
                       "NM" => 'New Mexico',
                       "NY" => 'New York',
                       "NC" => 'North Carolina',
                       "ND" => 'North Dakota',
                       "OH" => 'Ohio',
                       "OK" => 'Oklahoma',
                       "OR" => 'Oregon',
                       "PA" => 'Pennsylvania',
                       "RI" => 'Rhode Island',
                       "SC" => 'South Carolina',
                       "SD" => 'South Dakota',
                       "TN" => 'Tennessee',
                       "TX" => 'Texas',
                       "UT" => 'Utah',
                       "VT" => 'Vermont',
                       "VA" => 'Virginia',
                       "WA" => 'Washington',
                       "WV" => 'West Virginia',
                       "WI" => 'Wisconsin',
                       "WY" => 'Wyoming',];
        } else {
            $states = ["AB" => "Alberta",
                       "BC" => "British Columbia",
                       "MB" => "Manitoba",
                       "NB" => "New Brunswick",
                       "NL" => "Newfoundland and Labrador",
                       "NT" => "Northwest Territories",
                       "NS" => "Nova Scotia",
                       "NU" => "Nunavut",
                       "ON" => "Ontario",
                       "PE" => "Prince Edward Island",
                       "QC" => "Quebec",
                       "SK" => "Saskatchewan",
                       "YT" => "Yukon",

            ];
        }

        return $states;

    }

    public function getCreditcardType() {

        return ['amex'     => 'American Express',
                'discover' => 'Discover',
                'master'   => 'Master Card',
                'visa'     => 'Visa',];

    }

    public static function getStatusMap() {

        $resp                         = [];
        $resp[self::STATUS_PENDING]   = 'Pending';
        $resp[self::STATUS_CONFIRMED] = 'Confirmed';
        $resp[self::STATUS_FAILED]    = 'Failed';
        $resp[self::STATUS_CANCELED]    = 'Canceled';

        return $resp;
    }

}
