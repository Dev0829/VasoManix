<?php
namespace app\controllers;

use app\helpers\AuthHelper;
use app\helpers\UtilityHelper;
use app\models\Forms\UpsellForm;
use app\models\Orders;
use app\models\OrderStepOne;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class UpsellController extends Controller
{
  public function actionUpsellProcess() {
    $model = new UpsellForm();
    
    if ($model->load($_REQUEST)) {
      if ($model->validate()) {
        $old_order = Orders::findOne(['id' => $model->previous_order_id]);
        $product = UtilityHelper::getCustomParameters($_REQUEST['UpsellForm']['upsell_product']);
        $old_order->productId = ($old_order->payment_processor == 'credit_card') ? $product['cc'] : $product['pp'];
        
        $products[] = [
          'id'     => $old_order->productId,
          'name'   => $product['name'],
          'amount' => $product['amount'],
        ];
        
        $upsell_order = Orders::createOrder($old_order, $products, 5, 0);

        if($old_order->payment_processor == 'credit_card'){
          AuthHelper::doPayment($upsell_order);
          $upsell = Orders::findOne($upsell_order);

          if ($upsell->status == Orders::STATUS_CONFIRMED) {
            unset($_SESSION['previous_order']);
            $data = ['status' => '100', 'redirect_to' => '/products/order/thankyou'];
            return json_encode($data);
          } else {
            //$model->addError('OrderError', $order->errorMessage);
            return Yii::$app->response->content = $upsell->errorMessage;
          }
        }elseif ($old_order->payment_processor == 'paypal' && isset($_REQUEST['pp_subscription_id'])){
          $upsell = Orders::findOne($upsell_order);
          $upsell->pp_subscription_id = $_REQUEST['pp_subscription_id'];
          unset($_SESSION['previous_order']);
          $upsell->save();
          return;
        }
    } else {
        $errors = '';
        foreach ($model->errors as $field => $error) {
          $errors .= $model->getAttributeLabel($field) . ': ' . $error[0] . '<br>';
        }
        return Yii::$app->response->content = $errors;
    }
    }else{
      return Yii::$app->response->content = "No Previous Order";
    }
  }
}