<?php
namespace app\controllers;

use yii\web\Controller;

class ReturnpolicyController extends Controller
{
    /**
     * Displays Return Policy Page.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
