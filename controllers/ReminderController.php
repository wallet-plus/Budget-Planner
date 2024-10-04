<?php

namespace app\controllers;
use Yii;
use app\models\Reminders;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReminderController implements the CRUD actions for Reminders model.
 */
class ReminderController extends Controller
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
     * Lists all Reminders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Reminders::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_reminder' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reminders model.
     * @param int $id_reminder Id Reminder
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_reminder)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_reminder),
        ]);
    }

    /**
     * Creates a new Reminders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Reminders();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id_reminder' => $model->id_reminder]);
                Yii::$app->session->setFlash('success', "Reminder created successfully."); 
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
     * Updates an existing Reminders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_reminder Id Reminder
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_reminder)
    {
        $model = $this->findModel($id_reminder);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id_reminder' => $model->id_reminder]);
            Yii::$app->session->setFlash('success', "Reminder updated successfully."); 
            $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reminders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_reminder Id Reminder
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_reminder)
    {
        $this->findModel($id_reminder)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reminders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_reminder Id Reminder
     * @return Reminders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_reminder)
    {
        if (($model = Reminders::findOne(['id_reminder' => $id_reminder])) !== null) {
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
