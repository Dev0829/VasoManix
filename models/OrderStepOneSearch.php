<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderStepOne;

/**
 * OrderStepOneSearch represents the model behind the search form of `app\models\OrderStepOne`.
 */
class OrderStepOneSearch extends OrderStepOne
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['firstName', 'lastName', 'phone', 'email', 'shippingAddress1', 'shippingZip', 'shippingCity', 'shippingCountry', 'shippingState', 'ip_address', 'keyword', 'adgroupid', 'utm_campaign', 'utm_content', 'date_created'], 'safe'],
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
     * @param bool  $isExport
     * @return ActiveDataProvider
     */
    public function search($params, $isExport = FALSE)
    {
        $query = OrderStepOne::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'shippingAddress1', $this->shippingAddress1])
            ->andFilterWhere(['like', 'shippingZip', $this->shippingZip])
            ->andFilterWhere(['like', 'shippingCity', $this->shippingCity])
            ->andFilterWhere(['like', 'shippingCountry', $this->shippingCountry])
            ->andFilterWhere(['like', 'shippingState', $this->shippingState])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'adgroupid', $this->adgroupid])
            ->andFilterWhere(['like', 'utm_campaign', $this->utm_campaign])
            ->andFilterWhere(['like', 'utm_content', $this->utm_content]);


        if($isExport){
            $this->tryExport($query->all());
        }


        return $dataProvider;
    }

    public function tryExport($query) {

        $labels = $this->attributeLabels();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export-orders.csv');

        $output = fopen('php://output', 'w');
        // output the column headings
        fputcsv($output,array_values($labels));

        foreach ($query as $order){
            $dataToAdd = [];
            foreach ($labels as $key => $label){
                $dataToAdd[] = $order->$key;
            }
            fputcsv($output, $dataToAdd);
        }

        die();

    }
}
