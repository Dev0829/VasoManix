<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

class ContactController extends Controller
{
  /**
   * Displays Contact Page.
   *
   * @return string
   */
  public function actionIndex()
  {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
        Yii::$app->session->setFlash('contactFormSubmitted');

        return $this->refresh();
    }
    return $this->render('index', ['model' => $model,]);
  }
  /**
   * Process Contact Submit.
   *
   * @return Response|string
   */
  public function actionContactProcess()
  {
    if(isset($_REQUEST) && count($_REQUEST) > 0)
    {
      $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
      $field_message = trim($_REQUEST['message']);
      $field_message = filter_var($field_message, FILTER_SANITIZE_STRING);
      $field_name = filter_var(trim($_REQUEST['name']), FILTER_SANITIZE_STRING);

      $to = 'contact@primanixpro.com';
      $from = $email;
      $subject = "Primanix Support | " . $field_name;

      $message = "Message from $field_name:\n";
      $message .= "$from" . "\n\n";
      $message .= $field_message . "\n\n";

      $headers = "MIME-Version: 1.0rn";
      $headers .= "Content-type: text/html; charset=iso-8859-1rn";
      $headers .= "From: $from\r\n";

      $sendMail = mail($to, $subject, $message, $headers);
      if ($sendMail) {
        $status = 200;
        $message = 'Message has been successfully sent.';
      } else {
        $status = 500;
        $message = 'Internal Server Error';
      }
    } else {
      $status = 403;
      $message = 'Forbidden';
    }
    return Yii::$app->response->content = json_encode(['status' => $status, 'message' => $message]);
  }
}
