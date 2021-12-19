<?php

use yii\db\Migration;

/**
 * Class m210603_144449_order_step_one_table
 */
class m210603_144449_order_step_one_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('order_step_one', [
            'id' => $this->primaryKey(),

            'firstName' => $this->string(),
            'lastName' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'shippingAddress1' => $this->string(),
            'shippingZip' => $this->string(),
            'shippingCity' => $this->string(),
            'shippingCountry' => $this->string(),
            'shippingState' => $this->string(),

            'keyword' => $this->string(),
            'adgroupid' => $this->string(),
            'utm_campaign' => $this->string(),
            'utm_content' => $this->string(),

            'ip_address' => $this->string(),
            'date_created' => $this->dateTime(),
            ], 'ENGINE InnoDB');


    }

    public function down()
    {
        echo "m210603_144449_order_step_one_table cannot be reverted.\n";

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
        echo "m210603_144449_order_step_one_table cannot be reverted.\n";

        return false;
    }


}
