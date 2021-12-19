<?php

namespace app\modules\admin\controllers;

use app\controllers\CController;
use Yii;
use app\models\Orders;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;
use app\helpers\UtilityHelper;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends AdminAccessController
{

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex() {



        $isExport = FALSE;
        if (isset($_REQUEST['export']) && $_REQUEST['export'] == 1) {
            $isExport = TRUE;
        }
        $searchModel = new OrderSearch();
        $pagination = isset($_REQUEST['pageSize']) ? $_REQUEST['pageSize'] : 50;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $isExport, $pagination);

        if ($isExport) {


            $header = 'Order ID,Date Time,Status,Email Address,Shipping First Name,Shipping Last Name,Shipping Address,Shipping City,Shipping State,Shipping Zip/Postal,Shipping Country,Phone,Payment Type, Credit Card #, Credit Card Expiration, Credit Card CVV, Campaign, Mid, Transaction Id,Auth id, Product_ID_1, Product_Amount_1, Product_ID_2, Product_Amount_2, Shipping id, Shipping Amount, Total Price, Promo Code, AD Group Id, Keyword, SMS Terms';
            $headerArray = explode(',', $header);
            $output = fopen('php://output', 'w');

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=export-orders.csv');

            // output the column headings
            fputcsv($output, $headerArray);
            foreach ($dataProvider as $order) {
                $dataToAdd = [];
                $dataToAdd[] = $order->id;
                $dataToAdd[] = $order->date_created;
                $dataToAdd[] = $order->showStatus();
                $dataToAdd[] = $order->email;
                $dataToAdd[] = $order->firstName;
                $dataToAdd[] = $order->lastName;
                $dataToAdd[] = $order->shippingAddress1;
                $dataToAdd[] = $order->shippingCity;
                $dataToAdd[] = $order->shippingState;
                $dataToAdd[] = 'txt' . $order->shippingZip;
                $dataToAdd[] = $order->shippingCountry;
                $dataToAdd[] = 'txt' . $order->phone;

                //$dataToAdd[] = 'cc';

                $dataToAdd[] = $order->creditCardType;
                $dataToAdd[] = 'txt' . $order->cardNumber;
                $dataToAdd[] = 'txt' . $order->expirationDate;
                $dataToAdd[] = 'txt' . $order->cvv;
                $dataToAdd[] = $order->campaignId; //mid
                $dataToAdd[] = $order->mid; //mid
                $dataToAdd[] = 'txt' . $order->transactionNumber;
                $dataToAdd[] = 'txt' . $order->authCode;

                $items = $order->getItems();

                $items_ids = '';
                $items_amounts = '';
                $items_int = 0;
                $last = end($items);
                foreach ($items as $item) {
                    if($items_int == 0){
                        $dataToAdd[] = $item->productId;
                        $dataToAdd[] = $item->amount;
                    }else{
                        if($item == $last){
                            $items_ids .= $item->productId;
                            $items_amounts .= $item->amount;
                        }else{
                            $items_ids .= $item->productId . ', ';
                            $items_amounts .= $item->amount . ', ';
                        }
                    }
                    $items_int++;

                }

                $dataToAdd[] = $items_ids;
                $dataToAdd[] = $items_amounts;

                $dataToAdd[] = $order->shippingId;
                $dataToAdd[] = $order->shippingAmount;

                $dataToAdd[] = $order->amount;
                $dataToAdd[] = $order->promo_code;
                $dataToAdd[] = $order->adgroupid;
                $dataToAdd[] = $order->keyword;
                $dataToAdd[] = $order->sms_terms;


                fputcsv($output, $dataToAdd);

            }

            die;


        }

        return $this->render('index', ['searchModel'  => $searchModel,
                                       'dataProvider' => $dataProvider,
                                       'pagination'   => $pagination]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view',
                                    'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view',
                                    'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {

        if (($model = Orders::findOne($id)) !== NULL) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
