<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use app\models\Orders;
 

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index admin-title">
    

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="admin-titleb">
    <div class='row'>
    <div class='col-lg-5 col-md-5 exportt'>
    <div class='pull-right'>
        <a class='btn btn-info' href="javascript: exportOrders();">Export</a>
       
    </div>
</div>
    <div class='col-lg-7 col-md-7'>
        <label>Items per page</label>
        <select name='pageSize' class='form-control' onchange='changePageSize();'>
            <option <?php echo $pagination == 50 ? 'selected' : '' ?> value='50'>50</option>
            <option <?php echo $pagination == 100 ? 'selected' : '' ?> value='100'>100</option>
            <option <?php echo $pagination == 500 ? 'selected' : '' ?> value='500'>500</option>
            <option <?php echo $pagination == 1000 ? 'selected' : '' ?> value='1000'>1000</option>

        </select>

    </div>
    </div>
    </div>
    <br />
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if($model->status == Orders::STATUS_CONFIRMED){
                return ['class' => 'success'];
            }
            if($model->status == Orders::STATUS_CANCELED){
                return ['class' => 'warning'];
            }
            if($model->status == Orders::STATUS_FAILED){
                return ['class' => 'danger'];
            }
            if($model->status == Orders::STATUS_PENDING){
                return ['class' => 'info'];
            }

        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'date_created',
            //'mid',
            'campaignId',
            'transactionNumber',
            //'productId',
            //'orderId',
            //'transactionNumber',
            
            [
            'header' => 'Items',
            'format' => 'html',
            'value' => function($model){
                $userItems = $model->getItems();
                $html = '';
                foreach($userItems as $item){
                    $suffix = '';
                    if($item->productId > 0){
                        $suffix = ' ('.$item->productId.')';
                    }
            
                    $html .= $item->name.$suffix.'<br />';
                }
                return count($userItems) == 0 ? 'None' : $html;
            }
            ],
            
            [
                        'label'=>'Status',
                        'filter' => Html::activeDropDownList($searchModel, 'status', Orders::getStatusMap(),['class'=>'form-control','prompt' => 'Show All']),
                        'headerOptions' => ['style' => 'width:140px'],
                        'value'=>function ($data) {
                            $disp = $data->showStatus();
                            return $disp;
                        },
            ],      

            //'amount',
            'email:email',
            'firstName',
            'lastName',
            'phone',
            'avsCode',
            'shippingAddress1',
            'shippingZip',
            'cardNumber',
            //'shippingCity',
            //'shippingCountry',
            //'shippingState',
            //'billingSameAsShipping',
            //'billingAddress1',
            //'billingZip',
            //'billingCity',
            //'billingCountry',
            //'billingState',
            'creditCardType',
            //'last4',
            //'expirationDate',
            //'isExpeditedShipping',

            //'errorMessage',

            'adgroupid',
            'keyword',
            'utm_campaign',
            'utm_content',

            'payment_processor',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} ',
                'buttons' => [
                    'view' => function ($url,$model,$key) {
                        $edit = '';
                        $viewHtml = Html::a('View', '/admin/orders/view/?id='. $model->id);

                        return $viewHtml.$edit;
                    },

                ],],
        ],
    ]); ?>
</div>
<script type="text/javascript">
function exportOrders(){
	var  params = 'export=1';
	var newUrl = window.location.href ;
	if(newUrl.indexOf('?') == -1){
		newUrl += '?' + params;
	}else{
		newUrl += '&' + params;
		
	}
	window.location.href = newUrl;
}

function changePageSize(){
    var  params = '&pageSize='+$('select[name="pageSize"]').val();
    if(window.location.href.indexOf('pageSize') > 0)
        window.location.href = window.location.href.replace(/pageSize=\d+/, "pageSize="+$('select[name="pageSize"]').val());
    else {
        if(window.location.href.indexOf('?')  === -1)
            params = '?pageSize='+$('select[name="pageSize"]').val();
        window.location.href = window.location.href + params;
    }


}
</script>