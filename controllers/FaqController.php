<?php
namespace app\controllers;

use yii\web\Controller;

class FaqController extends Controller
{
  /**
   * Displays FAQ Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}
