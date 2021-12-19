<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gateways */

$this->title = 'Create Gateways';
$this->params['breadcrumbs'][] = ['label' => 'Gateways', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gateways-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
