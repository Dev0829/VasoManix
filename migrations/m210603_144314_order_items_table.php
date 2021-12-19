<?php

use yii\db\Migration;

/**
 * Class m210603_144314_order_items_table
 */
class m210603_144314_order_items_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'orderId' => $this->integer()->notNull(),
            'productId' => $this->integer()->notNull(),
            'name' => $this->string(),
            'quantity' => $this->integer(),
            'amount' => $this->double(),
        ], 'ENGINE InnoDB');
        $this->createIndex('order_items_orderId', 'order_items', 'orderId');

    }

    public function down()
    {
        echo "m210603_144314_order_items_table cannot be reverted.\n";

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
        echo "m210603_144314_order_items_table cannot be reverted.\n";

        return false;
    }

}
