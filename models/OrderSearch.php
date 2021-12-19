<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrderSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrderSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productId', 'campaignId', 'orderId', 'status', 'billingSameAsShipping', 'isExpeditedShipping'], 'integer'],
            [['transactionNumber','pp_subscription_id', 'email', 'firstName', 'lastName', 'phone', 'shippingAddress1', 'shippingZip', 'shippingCity', 'shippingCountry', 'utm_campaign', 'utm_content','shippingState', 'billingAddress1', 'billingZip', 'billingCity', 'billingCountry', 'billingState', 'creditCardType', 'last4', 'expirationDate','promo_code', 'date_created', 'errorMessage', 'keyword', 'adgroupid', 'payment_processor'], 'safe'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $isExport = false, $pagination = 50)
    {
        $query = Orders::find();

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pagination,
            ],
            'sort'=> ['defaultOrder' => ['id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'productId' => $this->productId,
            'campaignId' => $this->campaignId,
            'orderId' => $this->orderId,
            'status' => $this->status,
            'amount' => $this->amount,
            'billingSameAsShipping' => $this->billingSameAsShipping,
            'isExpeditedShipping' => $this->isExpeditedShipping,
            'date(date_created)' => $this->date_created,
            'utm_campaign' => $this->utm_campaign,
            'utm_content' => $this->utm_campaign,
            'payment_processor' => $this->payment_processor,
        ]);

        $query->andFilterWhere(['like', 'transactionNumber', $this->transactionNumber])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'shippingAddress1', $this->shippingAddress1])
            ->andFilterWhere(['like', 'shippingZip', $this->shippingZip])
            ->andFilterWhere(['like', 'shippingCity', $this->shippingCity])
            ->andFilterWhere(['like', 'shippingCountry', $this->shippingCountry])
            ->andFilterWhere(['like', 'shippingState', $this->shippingState])
            ->andFilterWhere(['like', 'billingAddress1', $this->billingAddress1])
            ->andFilterWhere(['like', 'billingZip', $this->billingZip])
            ->andFilterWhere(['like', 'billingCity', $this->billingCity])
            ->andFilterWhere(['like', 'billingCountry', $this->billingCountry])
            ->andFilterWhere(['like', 'billingState', $this->billingState])
            ->andFilterWhere(['like', 'creditCardType', $this->creditCardType])
            ->andFilterWhere(['like', 'last4', $this->last4])
            ->andFilterWhere(['like', 'expirationDate', $this->expirationDate])
            ->andFilterWhere(['like', 'promo_code', $this->promo_code])
            ->andFilterWhere(['like', 'errorMessage', $this->errorMessage])
        ->andFilterWhere(['like', 'adgroupid', $this->adgroupid])
        ->andFilterWhere(['like', 'keyword', $this->keyword]);
    
        if($isExport){
            return $query->all();
        }
        return $dataProvider;
    }
}
