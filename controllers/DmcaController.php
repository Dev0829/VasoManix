<?php
namespace app\controllers;
use yii\web\Controller;

class DmcaController extends Controller
{
  /**
   * Displays DMCA Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}
