<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GatewaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gateways';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="gateways-index admin-title">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="alignr cgateway">
        <?= Html::a('Create Gateways', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'campaignId',
            [
                'label'=>'Declined',
                'value'=>function ($data) {
                    return \app\models\Orders::countDeclinedOrdersByCampaign($data->campaignId);
                },
            ],
            [
            'label'=>'Status',
            'filter' => Html::activeDropDownList($searchModel, 'isActive', ['1' => 'Active', '2' => 'Inactive'],['class'=>'form-control','prompt' => 'Show All']),
            'headerOptions' => ['style' => 'width:140px'],
            'value'=>function ($data) {
                if($data->isActive == 1)
                    return 'Active';
                return 'Inactive';
            },
            ],
            'loginId',
            'gatewayCounter',
            'weight',
            //'transactionKey',
            //'gatewayCounter',
            //'date_created',
            //'date_updated',
            //'isAmexAllowed',
            //'isDiscoverAllowed',
            //'isMasterAllowed',
            //'isVisaAllowed',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => \yii\grid\ActionColumn::className(),'template'=>'{update}' ]

        ],
    ]); ?>
</div>
