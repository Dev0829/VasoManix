<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_step_one".
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $phone
 * @property string $email
 * @property string $shippingAddress1
 * @property string $shippingZip
 * @property string $shippingCity
 * @property string $shippingCountry
 * @property string $shippingState
 * @property string $ip_address
 * @property string $keyword
 * @property string $adgroupid
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $date_created
 */
class OrderStepOne extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_step_one';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'phone', 'email', 'shippingAddress1', 'shippingZip', 'shippingCity', 'shippingCountry', 'shippingState'], 'required'],
            [['date_created'], 'safe'],
            [['firstName', 'lastName', 'phone', 'email', 'shippingAddress1', 'shippingZip', 'shippingCity', 'shippingCountry', 'shippingState', 'ip_address', 'keyword', 'adgroupid', 'utm_campaign', 'utm_content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'shippingAddress1' => 'Shipping Address1',
            'shippingZip' => 'Shipping Zip',
            'shippingCity' => 'Shipping City',
            'shippingCountry' => 'Shipping Country',
            'shippingState' => 'Shipping State',
            'ip_address' => 'Ip Address',
            'keyword' => 'Keyword',
            'adgroupid' => 'Adgroupid',
            'utm_campaign' => 'Utm Campaign',
            'utm_content' => 'Utm Content',
            'date_created' => 'Date Created',
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
}
