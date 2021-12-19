<?php
namespace app\controllers;

use yii\web\Controller;

class PrivacyController extends Controller
{
    /**
     * Displays Privacy Page.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
