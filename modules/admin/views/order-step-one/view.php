<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStepOne */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Step Ones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-step-one-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'firstName',
            'lastName',
            'phone',
            'email:email',
            'shippingAddress1',
            'shippingZip',
            'shippingCity',
            'shippingCountry',
            'shippingState',
            'ip_address',
            'keyword',
            'adgroupid',
            'utm_campaign',
            'utm_content',
            'product_id',
            'date_created',
        ],
    ]) ?>

</div>
