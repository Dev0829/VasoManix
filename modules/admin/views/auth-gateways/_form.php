<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gateways */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gateways-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'campaignId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isActive')->dropDownList(['1' => 'Active', '2' => 'Inactive']) ?>

    <?= $form->field($model, 'loginId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transactionKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isAmexAllowed')->checkbox() ?>
    <?= $form->field($model, 'isDiscoverAllowed')->checkbox() ?>
    <?= $form->field($model, 'isMasterAllowed')->checkbox() ?>
    <?= $form->field($model, 'isVisaAllowed')->checkbox() ?>
    

    <?= $form->field($model, 'weight')->textInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
