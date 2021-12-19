<?php
namespace app\controllers;

use yii\web\Controller;

class AboutusController extends Controller
{
  /**
   * Displays About Us Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}
