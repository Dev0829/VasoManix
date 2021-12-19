<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderStepOneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Step Ones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-step-one-index admin-title">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="admin-titleb">
    <div class="row">
    <div class="col-md-8">
        <p>
            <?= Html::a('Create Order Step One', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <div class="col-md-4 text-right exportt"><a class='btn btn-info' href="javascript: exportCsv();">Export</a></div>
</div></div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date_created',
            'id',
            'firstName',
            'lastName',
            'phone',
            'email:email',
            //'shippingAddress1',
            //'shippingZip',
            //'shippingCity',
            //'shippingCountry',
            //'shippingState',
            //'ip_address',
            //'keyword',
            //'adgroupid',
            //'utm_campaign',
            //'utm_content',
            //'product_id',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script type="text/javascript">
    function exportCsv() {
        var url_string = window.location.href;
        var export_string = '?export=1';
        if(url_string.includes("?")){
            export_string = '&export=1';
        }
        window.location.href = window.location.href + export_string;
    }
</script>