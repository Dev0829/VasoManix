<?php
namespace app\controllers;

use yii\web\Controller;

class GuaranteeController extends Controller
{
  /**
   * Displays Guarantee Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}
