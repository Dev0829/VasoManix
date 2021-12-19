<?php
namespace app\controllers;
use yii\web\Controller;

class ThankyouController extends Controller
{
 /**
   * Return view of Order
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}