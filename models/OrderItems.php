<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $orderId
 * @property int $productId
 * @property string $name
 * @property int $quantity
 * @property double $amount
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderId', 'productId'], 'required'],
            [['orderId', 'productId', 'quantity'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'productId' => 'Product ID',
            'name' => 'Name',
            'quantity' => 'Quantity',
            'amount' => 'Amount',
        ];
    }
}
