<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStepOne */

$this->title = 'Update Order Step One: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Step Ones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-step-one-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
