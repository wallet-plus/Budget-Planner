<?php

namespace app\controllers;

use app\models\ExpenseCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExpenseCategoryController implements the CRUD actions for ExpenseCategory model.
 */
class ExpenseCategoryController extends Controller
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

    /**
     * Lists all ExpenseCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ExpenseCategory::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_category' => SORT_DESC,
                ]
            ],
            */
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
        $model = new ExpenseCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_category' => $model->id_category]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_category' => $model->id_category]);
        }

        return $this->render('update', [
            'model' => $model,
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
        $this->findModel($id_category)->delete();

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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
