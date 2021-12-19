<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;


AppAsset::register($this);


?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Main CSS File -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!-- <link rel="stylesheet"
              href="/assets/vendor/fontawesome-free/css/all.min.css"> -->
        <link rel="stylesheet" href="/products/css/style.css?v=0.56">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script type="text/javascript">
            WebFontConfig = {
                google: {families: ['Open Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Open Sans Condensed:700', 'Oswald:200,300,400,500,600,700', 'Shadows Into Light',]},
                custom: {
                    families: ['Font Awesome 5 Brands:400', 'Font Awesome 5 Free:400,900','porto'],
                    urls:['/assets/vendor/fontawesome-free/css/fonts.css','/css/porto.css']
                }
            };
            (function (d) {
                var wf = d.createElement('script'), s = d.scripts[0];
                //wf.src = '/assets/js/webfont.js';
                wf.async = true;
                s.parentNode.insertBefore(wf, s);
            })(document);
        </script>


    </head>
    <body class="loaded">
    <?php $this->beginBody() ?>

    <style>
        .kv-editor-container, .kv-code-container {
            min-width: 100%;
        }
        .kv-editor-container .btn-sm,   .kv-code-container .btn-sm{
            min-width: 35px;
        }
        .btn{
            min-width: 20px !important;
        }
    </style>

    <div class="wrap" id="admin">
        <div class="admin-top">
    <div class="container">
            <div class="header-box">
                <div class="logo"><a href="/products/"><img src="/products/images/logo.png" alt=""></a></div>
            </div>
        </div>
    </div>
                    <?php

                    NavBar::begin([
                                      //'brandLabel' => "<img src=\"/img/footer-logo.png\" alt=\"\" class=\" mx-xs-auto logo\">",
                                      'options' => [
                                          'class' => 'navbar navbar-expand-lg navbar-dark bg-dark',
                                      ],
                                  ]);


                    echo Nav::widget([
                                         'options' => ['class' => 'navbar-nav'],
                                         'items' => [
                                             ['label' => 'Orders',
                                              'options' => ['class' => 'nav-item dropdown'],

                                              'items' => [['label' => 'All Orders',
                                                           'url'   => '/admin/orders'],

                                                          ['label' => 'Auth Net',
                                                           'url'   => '/admin/orders?OrderSearch%5Bpayment_processor%5D=credit_card'],
                                                          ['label' => 'Paypal',
                                                           'url'   => '/admin/orders?OrderSearch%5Bpayment_processor%5D=paypal'],],],
                                             ['label'       => 'Auth Gateways',
                                              'url'         => ['/admin/auth-gateways'],
                                              'linkOptions' => [],],
                                             ['label' => 'Order Step One',
                                              'url'   => '/admin/order-step-one'],
                                             [
                                                 'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                                 'url' => ['/admin/default/logout'],
                                                 'visible' => !Yii::$app->user->isGuest
                                             ],
                                            ],


                                         // set this to nav-tab to get tab-styled navigation
                                     ]);

                    NavBar::end();


                    ?>



        <div class="container-fluid">
            <?= $content ?>
        </div>
    </div>

    <?php
    //$this->registerJsFile( '/js/bootstrap.js', [\yii\web\JqueryAsset::className()]);
    ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>