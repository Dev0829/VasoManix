<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Order #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view admin-title">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'productId',
            //'campaignId',
            //'orderId',
            'mid',
            'authCode',
            'transactionNumber',
            'status',
            'amount',
            'email:email',
            'firstName',
            'lastName',
            'phone',
            'shippingAddress1',
            'shippingZip',
            'shippingCity',
            'shippingCountry',
            'shippingState',
//             'billingSameAsShipping',
//             'billingAddress1',
//             'billingZip',
//             'billingCity',
//             'billingCountry',
//             'billingState',
            'cardNumber',
            'creditCardType',
            'last4',
            'expirationDate',
            'isExpeditedShipping',
            'date_created',
            'errorMessage',
        ],
    ]) ?>

         <?php 
    $userItems = $model->getItems();
    
    if(count($userItems) == 0){
    ?>
    <h2>No Items Selected</h2>
    <?php 
    }else{
    ?>
    <h2>Selected Items: </h2>
    <?php foreach($userItems as $item){
        $suffix = '';
        if($item->productId > 0){
            $suffix = ' ('.$item->productId.')';
        }
        ?>
    <h4><?php echo $item->name.$suffix?>&nbsp;</h4>
    <?php }?>
    <?php 
    }
    ?>
</div>
