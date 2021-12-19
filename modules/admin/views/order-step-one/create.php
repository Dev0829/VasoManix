<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStepOne */

$this->title = 'Create Order Step One';
$this->params['breadcrumbs'][] = ['label' => 'Order Step Ones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-step-one-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
