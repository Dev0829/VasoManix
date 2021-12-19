<?php

namespace app\modules\admin\controllers;

use app\helpers\BrowseImagesHelper;
use app\models\Forms\ProductImageUploadForm;
use Spatie\Image\Image;
use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends   AdminAccessController
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $path = Yii::getAlias('@webroot')."/uploads/products/" . $model->product_link;
            FileHelper::createDirectory($path,  0775, true);
            FileHelper::createDirectory($path . '/thumbnails/',  0775, true);
            FileHelper::createDirectory($path . '/optimized/', 0775, true);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {



        $upload_image_model = new ProductImageUploadForm();
        if (Yii::$app->request->isPost && isset($_REQUEST['ProductImageUploadForm'])) {
            $upload_image_model->imageFile = ProductImageUploadForm::getInstance($upload_image_model, 'imageFile');
            if ($upload_image_model->upload()) {
                // file is uploaded successfully
                return;
            }
        }


        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'upload_image_model' => $upload_image_model
        ]);
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionImages() {

        $images = isset($_GET['product']) ? $_GET['product'] : '';

        return BrowseImagesHelper::list_product_images($images);
    }

    public function actionUploadImage() {
        $upload_image_model = new ProductImageUploadForm();




        if (Yii::$app->request->isPost && isset($_REQUEST['product'])) {

            $upload_image_model->imageFile = UploadedFile::getInstance($upload_image_model, 'imageFile');
            if(isset($_REQUEST['thumbnail']) && $_REQUEST['thumbnail'] == 1){
                $upload_image_model->thumbnails = 1;
            }

            $upload_image_model->product = $_REQUEST['product'];

            if ($upload_image_model->upload()) {

                return true;
            }else{
                ;
                return json_encode(['error' => json_encode($upload_image_model->errors)]);
            }
        }
    }

    public function actionVideos() {
        $path = isset($_GET['path']) ? $_GET['path'] : '';
        return BrowseImagesHelper::list_video_directories($path);
    }
}
