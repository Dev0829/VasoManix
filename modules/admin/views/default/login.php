<?php


use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
$this->registerCssFile("https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css");

$this->title                   = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$this->params['data'] = ['page'      => 'login',
                         'canonical' => 'login'];
?>

<section class="page-title adminp">
        <div class="container">
            <h1>Admin Login</h1>
       

   
<div class="admin-box">
    <?php
    $form = ActiveForm::begin(['id'          => 'login-form',
                               'fieldConfig' => ['template'     => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                                 'labelOptions' => ['class' => 'col-lg-1 control-label'],],]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => TRUE]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')
             ->checkbox(['template' => "<div class=\"col-lg-offset-2 col-lg-12 remembert\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login',
                                   ['class' => 'btn btn-primary',
                                    'name'  => 'login-button']) ?>
        </div>
        </div>
        </div>
    </section>

    <?php ActiveForm::end(); ?>

</div>
