<?php

namespace app\controllers;

class FrontController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
