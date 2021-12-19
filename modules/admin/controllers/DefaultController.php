<?php

namespace app\modules\admin\controllers;

use app\helpers\UtilityHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => TRUE,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            [
                'class' => AccessControl::className(),
                'only'  => ['index'],
                'rules' => [
                    [
                        'actions'  => ['index'],
                        'ips'     => UtilityHelper::getCustomParameters('ip_white_list'),
                        'allow'   => TRUE,
                        'roles'   => ['?'],
                    ],
                ],
            ]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {

        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : NULL,
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $model = new \app\models\Forms\LoginForm();
        if (($model->load(\Yii::$app->request->post()) && $model->login())) {
            if(UtilityHelper::isAdmin()){
                return $this->redirect('/products/admin/orders');
            }
        }

        return $this->render('login', ['model'=> $model]);

    }

    public function actionLogout() {

        \Yii::$app->user->logout();

        return $this->redirect('/admin');
    }

}
