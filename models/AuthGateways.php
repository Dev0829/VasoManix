<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_gateways".
 *
 * @property int $id
 * @property string $name
 * @property string $mid
 * @property int $isActive
 * @property string $loginId
 * @property string $transactionKey
 * @property double $gatewayCounter
 * @property string $date_created
 * @property string $date_updated
 * @property int $isAmexAllowed
 * @property int $isDiscoverAllowed
 * @property int $isMasterAllowed
 * @property int $isVisaAllowed
 * @property int $weight
 */
class AuthGateways extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_gateways';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['isActive', 'isAmexAllowed', 'isDiscoverAllowed', 'isMasterAllowed', 'isVisaAllowed', 'weight'], 'integer'],
            [['gatewayCounter'], 'number'],
            [['date_created', 'date_updated', 'campaignId'], 'safe'],
            [['name', 'mid', 'loginId', 'transactionKey'], 'string', 'max' => 250],
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
                $this->gatewayCounter = 1;
                 
            }
    
            return true;
        }
    
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mid' => 'Mid',
            'isActive' => 'Is Active',
            'loginId' => 'Login ID',
            'transactionKey' => 'Transaction Key',
            'gatewayCounter' => 'Gateway Counter',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'isAmexAllowed' => 'Is Amex Allowed',
            'isDiscoverAllowed' => 'Is Discover Allowed',
            'isMasterAllowed' => 'Is Master Allowed',
            'isVisaAllowed' => 'Is Visa Allowed',
            'weight' => 'Weight',
        ];
    }
    
    public static function getGateway($cardType = false){
    
        $extraSQL = '';
        if($cardType !== false && $cardType != ''){
            if($cardType == 'amex'){
                $extraSQL .= ' and isAmexAllowed = 1 ';
            }else if($cardType == 'discover'){
                $extraSQL .= ' and isDiscoverAllowed = 1 ';
            }else if($cardType == 'master'){
                $extraSQL .= ' and isMasterAllowed = 1 ';
            }else if($cardType == 'visa'){
                $extraSQL .= ' and isVisaAllowed = 1 ';
            }
        }
    
        $gateway = AuthGateways::find()->where("isActive = 1 ".$extraSQL." order by (gatewayCounter * weight) asc, id asc limit 1")->one();
    
        if($gateway){
            $gateway->gatewayCounter = $gateway->gatewayCounter + 1;
            $gateway->save();
            return $gateway;
        }
        return false;
    }

    public static function getGatewayByCampaign($cardType = false){

        $extraSQL = '';
        if($cardType !== false && $cardType != ''){
            if($cardType == 'amex'){
                $extraSQL .= ' and isAmexAllowed = 1 ';
            }else if($cardType == 'discover'){
                $extraSQL .= ' and isDiscoverAllowed = 1 ';
            }else if($cardType == 'master'){
                $extraSQL .= ' and isMasterAllowed = 1 ';
            }else if($cardType == 'visa'){
                $extraSQL .= ' and isVisaAllowed = 1 ';
            }
        }
        $extraSQL0 = ' and campaignId IN (115, 150, 154, 158, 160, 170, 173) ';

        $gateway = AuthGateways::find()->where("isActive = 1 ".$extraSQL0.$extraSQL." order by (gatewayCounter * weight) asc, id asc limit 1")->one();

        if($gateway){
            $gateway->gatewayCounter = $gateway->gatewayCounter + 1;
            $gateway->save();
            return $gateway;
        }
        return false;
    }

    public static function resetCounters() {

        AuthGateways::updateAll(['gatewayCounter' => 0]);

    }
}
