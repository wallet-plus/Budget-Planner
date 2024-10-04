<?php


namespace app\controllers;
use Yii;
use app\models\CardsType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CardsTypeController implements the CRUD actions for CardsType model.
 */
class CardsTypeController extends Controller
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
     * Lists all CardsType models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CardsType::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_cards_type' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CardsType model.
     * @param int $id_cards_type Id Cards Type
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_cards_type)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_cards_type),
        ]);
    }

    /**
     * Creates a new CardsType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CardsType();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id_cards_type' => $model->id_cards_type]);

                // return $this->redirect(['view', 'id_category' => $model->id_category]);
                Yii::$app->session->setFlash('success', "Category created successfully."); 
                $this->redirect(['index']);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CardsType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_cards_type Id Cards Type
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_cards_type)
    {
        $model = $this->findModel($id_cards_type);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id_cards_type' => $model->id_cards_type]);
            
            Yii::$app->session->setFlash('success', "Category updated successfully."); 
            $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CardsType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_cards_type Id Cards Type
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_cards_type)
    {
        $this->findModel($id_cards_type)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CardsType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_cards_type Id Cards Type
     * @return CardsType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_cards_type)
    {
        if (($model = CardsType::findOne(['id_cards_type' => $id_cards_type])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
