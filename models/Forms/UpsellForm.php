<?php


namespace app\models\Forms;


use app\models\Orders;
use yii\base\Model;

class UpsellForm extends Model
{
    public $terms;
    public $previous_order_id;

    public function rules() {

        return [

            [['terms', 'previous_order_id'], 'integer'],

            [['terms'], 'required', 'requiredValue' => 1, 'message' => 'Field Required'],
            [['previous_order_id'], 'required'],
            [['previous_order_id'], 'validateOrder'],

        ];
    }

    public function validateOrder($attribute, $params) {



        if (Orders::findOne(['id' => $this->previous_order_id])) {

        }else{
            $this->addError('previous_order_id', 'There is no such previous order Id in our database');
        }
    }
}