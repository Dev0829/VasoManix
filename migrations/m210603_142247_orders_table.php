<?php

use yii\db\Migration;

/**
 * Class m210603_142247_orders_table
 */
class m210603_142247_orders_table extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'productId' => $this->integer(),
            'campaignId' => $this->integer(),
            'orderId' => $this->integer()->notNull(),
            'pp_subscription_id' => $this->string(),
            'transactionNumber' => $this->string(),
            'status' => $this->integer()->notNull(),
            'amount' => $this->double(),
            'email' => $this->string(),
            'firstName' => $this->string(),
            'lastName' => $this->string(),
            'phone' => $this->string(),
            'avsCode' => $this->string(2),
            'shippingAddress1' => $this->string(),
            'shippingZip' => $this->string(),
            'shippingCity' => $this->string(),
            'shippingCountry' => $this->string(),
            'shippingState' => $this->string(),
            'billingSameAsShipping' => $this->integer()->defaultValue(1),
            'billingAddress1' => $this->string(),
            'billingZip' => $this->string(),
            'billingCity' => $this->string(),
            'billingCountry' => $this->string(),
            'billingState' => $this->string(),
            'creditCardType' => $this->string(),
            'last4' => $this->string(5),
            'expirationDate' => $this->string(),
            'isExpeditedShipping' => $this->integer()->defaultValue(0),
            'date_created' => $this->dateTime(),
            'errorMessage' => $this->string(500),
            'gatewayId' => $this->integer(),
            'apiDuration' => $this->double(),
            'shippingId' => $this->integer(),
            'shippingAmount' => $this->double()->defaultValue(0),
            'mid' => $this->string(),
            'cardNumber' => $this->string(),
            'cvv' => $this->string(10),
            'authCode' => $this->string(),
            'promo_code' => $this->string(),
            'keyword' => $this->string(),
            'adgroupid' => $this->string(),
            'utm_campaign' => $this->string(),
            'utm_content' => $this->string(),
            'payment_processor' => $this->string(),
            'ip_address' => $this->string(),
            'sms_terms' => $this->integer(),


        ], 'ENGINE InnoDB');

    }

    public function down()
    {
        echo "m210603_142247_orders_table cannot be reverted.\n";

        return false;
    }




    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210603_142247_orders_table cannot be reverted.\n";

        return false;
    }

}
