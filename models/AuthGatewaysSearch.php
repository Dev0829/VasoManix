<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthGateways;

/**
 * AuthGatewaysSearch represents the model behind the search form of `app\models\AuthGateways`.
 */
class AuthGatewaysSearch extends AuthGateways
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'isActive', 'isAmexAllowed', 'isDiscoverAllowed', 'isMasterAllowed', 'isVisaAllowed', 'weight'], 'integer'],
            [['name', 'mid', 'loginId', 'transactionKey', 'date_created', 'date_updated', 'campaignId'], 'safe'],
            [['gatewayCounter'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params)
    {
        $query = AuthGateways::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'isActive' => $this->isActive,
            'gatewayCounter' => $this->gatewayCounter,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'isAmexAllowed' => $this->isAmexAllowed,
            'isDiscoverAllowed' => $this->isDiscoverAllowed,
            'isMasterAllowed' => $this->isMasterAllowed,
            'isVisaAllowed' => $this->isVisaAllowed,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mid', $this->mid])
            ->andFilterWhere(['like', 'campaignId', $this->campaignId])
            ->andFilterWhere(['like', 'loginId', $this->loginId])
            ->andFilterWhere(['like', 'transactionKey', $this->transactionKey]);

        return $dataProvider;
    }
}
