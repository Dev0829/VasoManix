<?php
namespace app\controllers;

use yii\web\Controller;

class TestimonialController extends Controller
{
  /**
   * Displays Testimonial Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    return $this->render('index', []);
  }
}
