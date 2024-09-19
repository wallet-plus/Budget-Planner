<?php

namespace app\controllers;
use Yii;
use app\models\ExpenseCategory;
use app\models\Type;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * CategoryController implements the CRUD actions for ExpenseCategory model.
 */
class CategoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function __construct($id, $module, $config = [])
    {
       
        
        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];
        
        parent::__construct($id, $module, $config);
    }



    /**
     * Lists all ExpenseCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => ExpenseCategory::find(),
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'category_name' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExpenseCategory model.
     * @param int $id_category Id Categories
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_category)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_category),
        ]);
    }

    /**
     * Creates a new ExpenseCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $catagories = ArrayHelper::map(ExpenseCategory::find()->all(), 'id_category', 'category_name');
        $types = ArrayHelper::map(Type::find()->all(), 'id_type', 'name');
        
        $model = new ExpenseCategory();

        if ($this->request->isPost) {

            $model->id_user = Yii::$app->user->id;


            if (isset($_FILES['ExpenseCategory']['name']['imageFile'])) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->imageFile) {
                    $imageName = Yii::$app->security->generateRandomString(10) . '.' . $model->imageFile->extension;
                    $uploadPath = Yii::getAlias('@webroot') . '/category/';
                    $model->imageFile->saveAs($uploadPath.$imageName);

                    // Compress and save the image
                    $image = Image::make($uploadPath.$imagePath);
                    $image->fit(200, 200);
                    $compressedImageName = 'wplus_' . $imageName;
                    $image->save($uploadPath . $compressedImageName);
                    
                    $model->category_image = $compressedImageName;
                }
            }

            if ($model->load($this->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id_category' => $model->id_category]);
                Yii::$app->session->setFlash('success', "Category created successfully."); 
                $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'catagories' => $catagories,
            'types' => $types
        ]);
    }

    /**
     * Updates an existing ExpenseCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_category Id Categories
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_category)
    {
        $model = $this->findModel($id_category);

        $catagories = ArrayHelper::map(ExpenseCategory::find()->all(), 'id_category', 'category_name');
        $types = ArrayHelper::map(Type::find()->all(), 'id_type', 'name');


        if ($model->load(Yii::$app->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
    
            if ($model->imageFile !== null) {
                if (!empty($oldImage)) {
                    $imagePath = Yii::getAlias('@webroot/category/') . $oldImage;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

               
                // Generate a unique image name
                $imageName = Yii::$app->security->generateRandomString(16) . '.' . $model->imageFile->extension;

                // Define the upload and image paths
                $uploadPath = Yii::getAlias('@webroot') . '/category/';
                $imagePath = $uploadPath . $imageName;

                // Save the new image using saveAs
                $model->imageFile->saveAs($imagePath);

                // Compress and save the image
                $image = Image::make($imagePath);
                $image->fit(400, 400);
                $compressedImageName = 'wplus_' . $imageName;
                $image->save($uploadPath . $compressedImageName);

                // Update the model's image attributes
                $model->category_image = $compressedImageName;
                $model->imageFile = null;
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Expense updated successfully."); 
                $this->redirect(['index']);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id_category' => $model->id_category]);
            Yii::$app->session->setFlash('success', "Category updated successfully."); 
            $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'catagories' => $catagories,
            'types' => $types
        ]);
    }

    /**
     * Deletes an existing ExpenseCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_category Id Categories
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_category)
    {

        $model = $this->findModel($id_category);
        // Get the category image file path
        $imagePath = Yii::getAlias('@webroot') . '/category/' . $model->category_image;

        if (file_exists($imagePath) && !is_dir($imagePath)) {
            // Delete the image file if it exists
            unlink($imagePath);
        }

        $model->delete();

        // $this->findModel($id_category)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExpenseCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_category Id Categories
     * @return ExpenseCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_category)
    {
        if (($model = ExpenseCategory::findOne(['id_category' => $id_category])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect(['/site/login']);
        }

        return parent::beforeAction($action);
    }
}
