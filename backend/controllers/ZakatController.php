<?php

namespace app\controllers;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\AccessControl;
use app\models\Expense;
use app\models\ExpenseCategory;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use DateTime;
use Firebase\JWT\JWT;
use yii\db\Query;
use yii\web\UploadedFile;
use app\models\Customer;
use yii\web\Response;
use Intervention\Image\ImageManagerStatic as Image;
use app\models\Countries;
use app\models\States;
use app\models\Cities;
use app\models\LocationPrices;


class ZakatController extends \yii\web\Controller
{   

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            
            if (!$user) {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:4200', 'https://secure.walletplus.in', 'https://walletplus.in'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }
 


    public function actionZakatCategories(){
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);


        $query = (new Query())
        ->select('*,bt_category.id_category as id_category ')
        ->from('bt_category')
        ->leftJoin('bt_category_configuation config', 'bt_category.id_category = config.id_category')
        ->where(['bt_category.id_type' => 5, 'bt_category.status' => 1]);
        $command = $query->createCommand();
        $list = $command->queryAll();
        $response['list'] = $list;

        // // $categories = ExpenseCategory::find();
        // ->where(['id_type' => 5])
        // // ->orderBy(['category_name' => SORT_ASC])
        // ->all();
        // $response['list'] = $list;
        $response['categoryImagePath'] = 'https://walletplus.in/category/';
        
        Yii::$app->response->statusCode = 200;
        return \yii\helpers\Json::encode($response);    
    }
    

    public function actionCountries() {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);

        $categories = Countries::find()
        // ->where(['id_type' => 5])
        // ->orderBy(['category_name' => SORT_ASC])
        ->all();

        $response['list'] = $categories;
        Yii::$app->response->statusCode = 200;
        return \yii\helpers\Json::encode($response);
    }


    public function actionStates() {
        $country = Yii::$app->getRequest()->getQueryParam('country');
        if($country){
            $states = States::find()
            ->where(['id_country' => $country])
            ->orderBy(['name' => SORT_ASC])
            ->all();
        }else{
            $states = States::find()->all();
        }

        $response['list'] = $states;
        Yii::$app->response->statusCode = 200;
        return \yii\helpers\Json::encode($response);
    }


    public function actionCities() {
        $state = Yii::$app->getRequest()->getQueryParam('state');
        if($state){
            $cities = Cities::find()
            ->where(['id_state' => $state])
            ->orderBy(['name' => SORT_ASC])
            ->all();
        }
        $response['list'] = $cities;
        Yii::$app->response->statusCode = 200;
        return \yii\helpers\Json::encode($response);
    }

    public function actionLocationPrices() {
        // $city = Yii::$app->getRequest()->getQueryParam('city');
        $city = 1;
        if($city){
            $prices = LocationPrices::find()
            ->where(['id_location' => $city])
            // ->orderBy(['name' => SORT_ASC])
            ->all();
        }
        $response['list'] = $prices;
        Yii::$app->response->statusCode = 200;
        return \yii\helpers\Json::encode($response);
    }
    






    public function beforeAction($action)
    {
        if (in_array($action->id, ['countries','states','cities','zakat-categories','statistics', 'category-list', 'get', 'update','delete', 'get-list', 'add', 'suggestion'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

}