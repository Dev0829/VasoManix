<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $productId
 * @property int $campaignId
 * @property int $orderId
 * @property string $pp_subscription_id
 * @property string $transactionNumber
 * @property int $status
 * @property double $amount
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property string $phone
 * @property string $shippingAddress1
 * @property string $shippingZip
 * @property string $shippingCity
 * @property string $shippingCountry
 * @property string $shippingState
 * @property int $billingSameAsShipping
 * @property string $billingAddress1
 * @property string $billingZip
 * @property string $billingCity
 * @property string $billingCountry
 * @property string $billingState
 * @property string $creditCardType
 * @property string $expirationDate
 * @property string $cardNumber
 * @property string $cvv
 * @property string $last4
 * @property int $isExpeditedShipping
 * @property string $promo_code
 * @property string $date_created
 * @property string $adgroupid
 * @property string $keyword
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $payment_processor
 * @property string $sms_terms
 * @property string $ip_address
 *
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 1;
    const STATUS_CONFIRMED = 2;
    const STATUS_FAILED = 3;
    const STATUS_CANCELED = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'campaignId', 'orderId', 'status', 'billingSameAsShipping', 'isExpeditedShipping', 'sms_terms'], 'integer'],
            [['orderId', 'status'], 'required'],
            [['amount'], 'number'],
            [['date_created', 'errorMessage', 'gatewayId', 'apiDuration', 'shippingId', 'shippingAmount', 'mid', 'cardNumber', 'cvv', 'authCode'], 'safe'],
            [['transactionNumber', 'pp_subscription_id', 'email', 'firstName', 'lastName', 'phone', 'avsCode', 'shippingAddress1', 'shippingZip', 'shippingCity', 'utm_campaign', 'utm_content','shippingCountry', 'shippingState', 'billingAddress1', 'billingZip', 'billingCity', 'billingCountry', 'billingState', 'creditCardType', 'last4', 'expirationDate', 'promo_code', 'adgroupid', 'keyword', 'payment_processor', 'ip_address'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productId' => 'Product ID',
            'campaignId' => 'Campaign ID',
            'orderId' => 'Order ID',
            'pp_subscription_id' => 'PP Subscription Id',
            'transactionNumber' => 'Transaction Number',
            'status' => 'Status',
            'amount' => 'Amount',
            'email' => 'Email',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone' => 'Phone',
            'avsCode' => 'AVS',
            'shippingAddress1' => 'Shipping Address1',
            'shippingZip' => 'Shipping Zip',
            'shippingCity' => 'Shipping City',
            'shippingCountry' => 'Shipping Country',
            'shippingState' => 'Shipping State',
            'billingSameAsShipping' => 'Billing Same As Shipping',
            'billingAddress1' => 'Billing Address1',
            'billingZip' => 'Billing Zip',
            'billingCity' => 'Billing City',
            'billingCountry' => 'Billing Country',
            'billingState' => 'Billing State',
            'creditCardType' => 'Credit Card Type',
            'last4' => 'Last4',
            'expirationDate' => 'Expiration Date',
            'isExpeditedShipping' => 'Is Expedited Shipping',
            'promo_code' => 'Promo Code',
            'date_created' => 'Date Created',
            'adgroupid' => 'Ad Group Id',
            'keyword' => 'Keyword',
            'utm_campaign' => 'UTM Campaign',
            'utm_content' => 'UTM Content',
            'ip_address' => 'IP Address',
            'payment_processor' => 'Payment Processor',
        ];
    }
    
    public function beforeSave($insert)
    {
    
        if (parent::beforeSave($insert)) {
    
            if ($this->isNewRecord) {
                /*
                $userTimeZone = new \DateTimeZone('UTC' );
                $advanceOrderTime = new \DateTime('now', $userTimeZone);
                $this->date_created = $advanceOrderTime->format('Y-m-d H:i:s');
                */
                date_default_timezone_set('America/New_York');
                $this->date_created = date("Y-m-d H:i:s");
               
            }
            
            return true;
        }
    
    }

    public function showStatus(){
        if($this->status == self::STATUS_PENDING){
            return 'Pending';
        }else         if($this->status == self::STATUS_CONFIRMED){
            return 'Confirmed';
        }else         if($this->status == self::STATUS_FAILED){
            return 'Failed ('.$this->errorMessage.')';
        }else         if($this->status == self::STATUS_CANCELED){
            return 'Canceled';
        }
    }

    public static function getStatusMap(){
        $resp = [];
        $resp[self::STATUS_PENDING] = 'Pending';
        $resp[self::STATUS_CONFIRMED] = 'Confirmed';
        $resp[self::STATUS_FAILED] = 'Failed';
        $resp[self::STATUS_CANCELED] = 'Canceled';

        return $resp;
    }
    
    public function getItems(){
        return OrderItems::findAll(['orderId' => $this->id]);
    
    }
    public static function countDeclinedOrdersByCampaign($campaignId){
        date_default_timezone_set('America/New_York');
        $date_created = date("Y-m-d");
        return Orders::find()->where(['campaignId' => $campaignId])->andWhere(['!=','status', '2'])->andWhere(['like', 'date_created' , $date_created .'%',false])->count();
    }

    static public function createOrder($params,
                                       $products,
                                       $shippingId,
                                       $shippingAmount,
                                       $paypal = FALSE) {


        $order                   = new Orders();
        $order->orderId          = 0;
        $order->status           = Orders::STATUS_PENDING;
        $order->payment_processor = $params['payment_processor'];



        if($order->payment_processor == 'credit_card'){
            $order->creditCardType   = $params['creditCardType'];
            $order->cardNumber       = $params['cardNumber'];
            $order->expirationDate   = isset($params->expirationDate) ? $params->expirationDate : $params['fields_expmonth'] . '/' . $params['fields_expyear'];
            $order->cvv              = $params['cvv'];
        }

        if (isset($params['keyword']) && (trim($params['keyword']) !== '')) {
            $order->keyword = $params['keyword'];
        }
        if (isset($params['adgroupid']) && (trim($params['adgroupid']) !== '')) {
            $order->adgroupid = $params['adgroupid'];
        }
        if (isset($params['utm_campaign']) && (trim($params['utm_campaign']) !== '')) {
            $order->utm_campaign = $params['utm_campaign'];
        }
        if (isset($params['utm_content']) && (trim($params['utm_content']) !== '')) {
            $order->utm_content = $params['utm_content'];
        }

        $order->pp_subscription_id   = isset($params['pp_subscription_id']) ? $params['pp_subscription_id'] : NULL ;

        $order->firstName        = $params['firstName'];
        $order->lastName         = $params['lastName'];
        $order->email            = $params['email'];
        $order->phone            = $params['phone'];
        $order->shippingZip      = $params['shippingZip'];
        $order->shippingAddress1 = $params['shippingAddress1'];
        $order->shippingCity     = $params['shippingCity'];
        $order->shippingCountry  = $params['shippingCountry'];
        $order->shippingState    = $params['shippingState'];

        if ($params['billingSameAsShipping'] === 'NO') {
            $order->billingSameAsShipping = 0;
            $order->billingZip            = $params['billingZip'];
            $order->billingAddress1       = $params['billingAddress1'];
            $order->billingCity           = $params['billingCity'];
            $order->billingCountry        = $params['billingCountry'];
            $order->billingState          = $params['billingState'];
        }

        $order->sms_terms = isset($params['sms_terms']) ? 1 : 0;


        $order->amount = 0;
        $order->save();


        $totalAmount = 0;
        foreach ($products as $item) {
            $orderItems            = new OrderItems();
            $orderItems->orderId   = $order->id;
            $orderItems->productId = $item['id'];
            $orderItems->name      = $item['name'];
            $orderItems->quantity  = 1;
            $orderItems->amount    = $item['amount'];
            $orderItems->save();

            $totalAmount += floatval($orderItems->amount);
        }
        $totalAmount           += floatval($shippingAmount);
        $order->shippingId     = $shippingId;
        $order->shippingAmount = $shippingAmount;



        $order->amount         = $totalAmount;

        $order->save();

        return $order->id;


    }

}
