<?php

namespace app\modules\admin\controllers;

use app\models\Forms\ImageUploadForm;
use Yii;
use app\models\UcsIngredients;
use app\models\UcsIngredientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UcsIngredientsController implements the CRUD actions for UcsIngredients model.
 */
class UcsIngredientsController extends AdminAccessController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UcsIngredients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UcsIngredientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UcsIngredients model.
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
     * Creates a new UcsIngredients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $upload_image_model = new ImageUploadForm();

        if (Yii::$app->request->isPost && isset($_REQUEST['ImageUploadForm'])) {
            $upload_image_model->imageFile = ImageUploadForm::getInstance($upload_image_model, 'imageFile');
            if ($upload_image_model->upload()) {
                // file is uploaded successfully
                return;
            }
        }


        $model = new UcsIngredients();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'upload_image_model' => $upload_image_model
        ]);
    }

    public function actionUploadImage() {
        $upload_image_model = new ImageUploadForm();

        if (Yii::$app->request->isPost) {
            $upload_image_model->imageFile = UploadedFile::getInstance($upload_image_model, 'imageFile');

            if ($upload_image_model->upload()) {

                return true;
            }else{
               ;
                return json_encode(['error' => json_encode($upload_image_model->errors)]);
            }
        }
    }

    /**
     * Updates an existing UcsIngredients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $upload_image_model = new ImageUploadForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'upload_image_model' => $upload_image_model,
        ]);
    }

    /**
     * Deletes an existing UcsIngredients model.
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
     * Finds the UcsIngredients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UcsIngredients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UcsIngredients::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
