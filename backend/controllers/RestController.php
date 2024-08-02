<?php

namespace app\controllers;
use yii\filters\auth\CompositeAuth;
// use app\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use Yii;

class RestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            // 'authMethods' => [
            //     HttpBearerAuth::className(),
            // ],

        ];

        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'view' => ['get'],
                'create' => ['post'],
                'update' => ['put'],
                'delete' => ['delete'],
                'login' => ['post'],
                'getPermissions' => ['get'],
            ],
        ];

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options', 'login'];

        // setup access
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index', 'view', 'create', 'update', 'delete', 'getPermissions'], //only be applied to
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index', 'view', 'create', 'update', 'delete', 'getPermissions'],
                    'roles' => ['admin', 'manageStaffs'],
                ],
            ],
        ];

        return $behaviors;
    }


    public function actionAjax()
    {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);
        return \yii\helpers\Json::encode($data);

        exit;

        $data = Yii::$app->request->post();
        // $name = $data['name'];
        // $email = $data['email'];
        
        // echo "<pre>";
        print_r($data);
        // exit;

        // if(isset(Yii::$app->request->post('test'))){
            $test = "Ajax Worked!";
        //     // do your query stuff here
        // }else{
        //     $test = "Ajax failed";
        //     // do your query stuff here
        // }

        // return Json    
        return \yii\helpers\Json::encode($data);
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['ajax'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

}
