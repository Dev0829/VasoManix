<?php
namespace app\controllers;

use yii\web\Controller;

class TermsController extends Controller
{
    /**
     * Displays Terms Page.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
