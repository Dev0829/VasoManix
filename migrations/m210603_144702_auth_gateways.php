<?php

use yii\db\Migration;

/**
 * Class m210603_144702_auth_gateways
 */
class m210603_144702_auth_gateways extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('auth_gateways', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'mid' => $this->string(),
            'isActive' => $this->integer()->notNull()->defaultValue(1),
            'loginId' => $this->string(),
            'transactionKey' => $this->string(),
            'gatewayCounter' => $this->double()->defaultValue(0),
            'isAmexAllowed' => $this->integer(),
            'isDiscoverAllowed' => $this->integer(),
            'isMasterAllowed' => $this->integer(),
            'isVisaAllowed' => $this->integer(),
            'weight' => $this->integer(),
            'campaignId' => $this->integer(),


            'date_created' => $this->dateTime(),
            'date_updated' => $this->dateTime(),
        ], 'ENGINE InnoDB row_format=dynamic');

        $this->createIndex('auth_gateways_isActive', 'auth_gateways', 'isActive');
        $this->createIndex('auth_gateways_name', 'auth_gateways', 'name');
        $this->createIndex('auth_gateways_campaignId', 'auth_gateways', 'campaignId');


    }

    public function down()
    {
        echo "m210603_144702_auth_gateways cannot be reverted.\n";

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
        echo "m210603_144702_auth_gateways cannot be reverted.\n";

        return false;
    }




}
