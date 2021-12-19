<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'productId') ?>

    <?= $form->field($model, 'campaignId') ?>

    <?= $form->field($model, 'orderId') ?>

    <?= $form->field($model, 'transactionNumber') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'firstName') ?>

    <?php // echo $form->field($model, 'lastName') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'shippingAddress1') ?>

    <?php // echo $form->field($model, 'shippingZip') ?>

    <?php // echo $form->field($model, 'shippingCity') ?>

    <?php // echo $form->field($model, 'shippingCountry') ?>

    <?php // echo $form->field($model, 'shippingState') ?>

    <?php // echo $form->field($model, 'billingSameAsShipping') ?>

    <?php // echo $form->field($model, 'billingAddress1') ?>

    <?php // echo $form->field($model, 'billingZip') ?>

    <?php // echo $form->field($model, 'billingCity') ?>

    <?php // echo $form->field($model, 'billingCountry') ?>

    <?php // echo $form->field($model, 'billingState') ?>

    <?php // echo $form->field($model, 'creditCardType') ?>

    <?php // echo $form->field($model, 'last4') ?>

    <?php // echo $form->field($model, 'expirationDate') ?>

    <?php // echo $form->field($model, 'isExpeditedShipping') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'errorMessage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
