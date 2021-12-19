<?php

namespace  app\modules\admin\controllers;

use app\helpers\UtilityHelper;
use Yii;
use app\models\OrderStepOne;
use app\models\OrderStepOneSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderStepOneController implements the CRUD actions for OrderStepOne model.
 */
class OrderStepOneController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'ips' => UtilityHelper::getCustomParameters('ip_white_list'),
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['submit'],
                        'allow' => true,

                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action){
        $this->layout = 'admin';

        return parent::beforeAction($action);
    }

    /**
     * Lists all OrderStepOne models.
     * @return mixed
     */
    public function actionIndex()
    {
        $isExport = false;
        if(isset($_REQUEST['export']) && $_REQUEST['export'] == 1){
            $isExport = true;
        }

        $searchModel = new OrderStepOneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $isExport);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderStepOne model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrderStepOne model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderStepOne();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new OrderStepOne model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSubmit()
    {

        $model = new OrderStepOne();

        $r['OrderStepOne'] = Yii::$app->request->post();

        if ($model->load($r) && $model->save()) {
            if(OrderStepOne::findOne(['email', trim($model->email)])){
                return "Already Saved";
            }
            $model->ip_address = UtilityHelper::getClientIp();
            date_default_timezone_set('America/New_York');
            $model->date_created = date("Y-m-d H:i:s");
            $model->save();
            return "200";
        }else{
            var_dump($model->errors);
            return "Error on Save";
        }
    }

    /**
     * Updates an existing OrderStepOne model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrderStepOne model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderStepOne model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderStepOne the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderStepOne::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
