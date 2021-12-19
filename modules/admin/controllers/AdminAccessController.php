<?php
namespace app\modules\admin\controllers;

use app\helpers\UtilityHelper;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 *
 * Admin Global Controller
 * In use, for Admin Pages Only
 * Class AGontroller
 * @package app\controllers
 */
class AdminAccessController extends Controller
{
    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'ips' => UtilityHelper::getCustomParameters('ip_white_list'),
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action){
        $this->layout = 'admin';

        if($action->controller->id !== 'default'){
            if(\Yii::$app->user == NULL || \Yii::$app->user->isGuest || UtilityHelper::isAdmin() === false){

                return $this->redirect('/admin');

            }
        }

        return parent::beforeAction($action);
    }

}