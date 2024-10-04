<?php

namespace app\controllers;
use Yii;
use app\models\EmailTemplates;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmailTemplatesController implements the CRUD actions for EmailTemplates model.
 */
class EmailTemplatesController extends Controller
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
     * Lists all EmailTemplates models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => EmailTemplates::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_email_template' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmailTemplates model.
     * @param int $id_email_template Id Email Template
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_email_template)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_email_template),
        ]);
    }

    /**
     * Creates a new EmailTemplates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new EmailTemplates();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id_email_template' => $model->id_email_template]);
                Yii::$app->session->setFlash('success', "Created successfully.");
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
     * Updates an existing EmailTemplates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_email_template Id Email Template
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_email_template)
    {
        $model = $this->findModel($id_email_template);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id_email_template' => $model->id_email_template]);
            Yii::$app->session->setFlash('success', "Updated successfully.");
                $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EmailTemplates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_email_template Id Email Template
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_email_template)
    {
        $this->findModel($id_email_template)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmailTemplates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_email_template Id Email Template
     * @return EmailTemplates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_email_template)
    {
        if (($model = EmailTemplates::findOne(['id_email_template' => $id_email_template])) !== null) {
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
