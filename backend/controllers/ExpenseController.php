<?php

namespace app\controllers;
use Yii;
use app\models\Expense;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ExpenseCategory;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\db\Expression;

/**
 * ExpenseController implements the CRUD actions for Expense model.
 */
class ExpenseController extends Controller
{

    public function __construct($id, $module, $config = [])
    {
        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];
        parent::__construct($id, $module, $config);
    }

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
                        'delete' => ['POST', 'GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Expense models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Expense::find()->where(['id_type'=>2, 'id_customer' =>Yii::$app->user->id]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            */
            'sort' => [
                'defaultOrder' => [
                    'id_expense' => SORT_DESC,
                ]
            ],
            
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expense model.
     * @param int $id_expense Id Expense
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_expense)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_expense),
        ]);
    }

    /**
     * Creates a new Expense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $catagories = ArrayHelper::map(ExpenseCategory::find()->orderBy(['category_name' => SORT_ASC])->where(['=','id_type','2'])->all(), 'id_category', 'category_name');
        $model = new Expense();

        if ($this->request->isPost) {
            $model->id_customer = Yii::$app->user->id;
            $model->created_by = Yii::$app->user->id;
            $model->date_created = new Expression('NOW()');

            


            if (isset($_FILES['Expense']['name']['imageFile'])) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->imageFile) {
                    $imageName = Yii::$app->security->generateRandomString(10) . '.' . $model->imageFile->extension;
                    $imagePath = Yii::getAlias('@webroot') . '/expenses/' . $imageName;
                    $model->imageFile->saveAs($imagePath);
                    $model->image = $imageName;
                }
            }

            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "Expense added successfully.");
                $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
            'catagories' => $catagories
        ]);
    }

    /**
     * Updates an existing Expense model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_expense Id Expense
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_expense)
    {
        $catagories = ArrayHelper::map(ExpenseCategory::find()->orderBy(['category_name' => SORT_ASC])->where(['=','id_type','2'])->all(), 'id_category', 'category_name');
        $model = $this->findModel($id_expense);
        $oldImage = $model->image; // save the old image name for later use

        
            if ($model->load(Yii::$app->request->post())) {
                $model->date_updated = new Expression('NOW()');
                $model->updated_by = Yii::$app->user->id;
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        
                if ($model->imageFile !== null) {
                    if (!empty($oldImage)) {
                        $imagePath = Yii::getAlias('@webroot/expenses/') . $oldImage;
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }

                   // Save the new image
                    $imageName = Yii::$app->security->generateRandomString(16) . '.' . $model->imageFile->extension;
                    $imagePath = Yii::getAlias('@webroot') . '/expenses/' . $imageName;
                    $model->imageFile->saveAs($imagePath);
                    $model->image = $imageName;
                    $model->imageFile = null;
                    
                }
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', "Expense updated successfully."); 
                    $this->redirect(['index']);
                }
            }

        return $this->render('update', [
            'model' => $model,
            'catagories' =>$catagories
        ]);
    }

    /**
     * Deletes an existing Expense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_expense Id Expense
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_expense)
    {
        // exit('control here');
        $this->findModel($id_expense)->delete();
        Yii::$app->session->setFlash('success', "Expense deleted successfully."); 
        return $this->redirect(['index']);
    }

    /**
     * Finds the Expense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_expense Id Expense
     * @return Expense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_expense)
    {
        if (($model = Expense::findOne(['id_expense' => $id_expense])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect(['/site/login']);
        }

        return parent::beforeAction($action);
    }
}
