<?php


namespace app\controllers;
use Yii;
use app\models\Cards;
use app\models\CardsType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;


/**
 * CardsController implements the CRUD actions for Cards model.
 */
class CardsController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cards models.
     *
     * @return string
     */
    public function actionIndex()
    {



        $cards = Cards::find()->where(['id_customer' => Yii::$app->user->id])->all();


        $dataProvider = new ActiveDataProvider([
            'query' => Cards::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_card' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'cards' => $cards,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Cards model.
     * @param int $id_card Id Card
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_card)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_card),
        ]);
    }

    /**
     * Creates a new Cards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cards();
        $types = ArrayHelper::map(CardsType::find()->all(), 'id_cards_type', 'name');

        if ($this->request->isPost) {


            if (isset($_FILES['Cards']['name']['imageFile'])) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->imageFile) {
                    $imageName = Yii::$app->security->generateRandomString(10) . '.' . $model->imageFile->extension;
                    $uploadPath = Yii::getAlias('@webroot') . '/cards/';
                    $model->imageFile->saveAs($uploadPath.$imageName);

                    // Compress and save the image
                    $image = Image::make($uploadPath.$imageName);
                    $image->encode('jpg', 70); 
                    $compressedImageName = 'wplus_' . $imageName;
                    $image->save($uploadPath . $compressedImageName);
                    
                    $model->image = $compressedImageName;
                }
            }


            // if ($model->load($this->request->post()) && $model->save()) {
            //     return $this->redirect(['view', 'id_card' => $model->id_card]);
            // }

            if ($model->load($this->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id_category' => $model->id_category]);
                Yii::$app->session->setFlash('success', "Card saved successfully."); 
                $this->redirect(['index']);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'types' => $types
        ]);
    }

    /**
     * Updates an existing Cards model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_card Id Card
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_card)
    {
        $model = $this->findModel($id_card);
        $types = ArrayHelper::map(CardsType::find()->all(), 'id_cards_type', 'name');

        


        if ($model->load(Yii::$app->request->post())) {
            $oldImage = $model->image;
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
    
            if ($model->imageFile !== null) {
                if (!empty($oldImage)) {
                    $imagePath = Yii::getAlias('@webroot/cards/') . $oldImage;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    $OriginalImage = str_replace('wplus_', '', $oldImage);
                    $imagePath = Yii::getAlias('@webroot/cards/') . $OriginalImage;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

               
                // Generate a unique image name
                $imageName = Yii::$app->security->generateRandomString(16) . '.' . $model->imageFile->extension;

                // Define the upload and image paths
                $uploadPath = Yii::getAlias('@webroot') . '/cards/';
                $imagePath = $uploadPath . $imageName;

                // Save the new image using saveAs
                $model->imageFile->saveAs($imagePath);

                // Compress and save the image
                $image = Image::make($imagePath);
                $image->encode('jpg', 70); 
                $compressedImageName = 'wplus_' . $imageName;
                $image->save($uploadPath . $compressedImageName);

                // Update the model's image attributes
                $model->image = $compressedImageName;
                $model->imageFile = null;
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Card saved successfully."); 
                $this->redirect(['index']);
            }
        }


        // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id_card' => $model->id_card]);
        // }

        return $this->render('update', [
            'model' => $model,
            'types' => $types
        ]);
    }

    /**
     * Deletes an existing Cards model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_card Id Card
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_card)
    {

        $model = $this->findModel($id_card);
        // Delete the associated image file if it exists
        $imageFileName = $model->image;
        if (!empty($imageFileName)) {
            $imagePath = Yii::getAlias('@webroot/cards/') . $imageFileName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $OriginalImage = str_replace('wplus_', '', $imageFileName);
            $imagePath = Yii::getAlias('@webroot/cards/') . $OriginalImage;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $model->delete();

        return $this->redirect(['index']);

        // $this->findModel($id_card)->delete();
        // return $this->redirect(['index']);
    }

    /**
     * Finds the Cards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_card Id Card
     * @return Cards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_card)
    {
        if (($model = Cards::findOne(['id_card' => $id_card])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
