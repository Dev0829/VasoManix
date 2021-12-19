<?php
namespace app\controllers;

use yii\web\Controller;

class SuperiorController extends Controller
{
  /**
   * Displays Size Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}
