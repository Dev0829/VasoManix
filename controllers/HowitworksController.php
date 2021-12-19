<?php
namespace app\controllers;

use yii\web\Controller;

class HowitworksController extends Controller
{
  /**
   * Displays How It works Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}
