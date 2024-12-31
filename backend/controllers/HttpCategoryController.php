<?php

namespace app\controllers;

use Yii;
use app\models\ExpenseCategory;
use yii\db\Query;
use yii\web\UploadedFile;
use app\models\Customer;
use app\models\Type;
use Intervention\Image\ImageManagerStatic as Image;

class HttpCategoryController extends \yii\web\Controller
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
                'Origin' => Yii::$app->params['allowedOrigins'],
                'Access-Control-Request-Method' => ['FETCH', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }

    public function actionCategoryTypes()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
 


                $types = Type::find();

                $types = $types->orderBy(['id_type' => SORT_ASC])->all();
                    
                $response['list'] = $types;
                $response['categoryImagePath'] = Yii::$app->params['categoryImagePath'];
                $response['imagePath'] = Yii::$app->params['expenseImagePath']; ;

                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode($response);
            } else {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
    }

    public function actionCategoryList()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                switch ($data['type']) {
                    case 'expense':
                        $id_type = 2;
                        break;
                    case 'savings':
                        $id_type = 1;
                        break;
                    case 'income':
                        $id_type = 3;
                        break;
                    default: 
                        $id_type = 0;
                        break;
                }

                $categories = ExpenseCategory::find();

                if ($id_type !== 0) {
                    $categories->where(['id_type' => $id_type]);
                }
                
                $categories->andWhere(['id_user' => 1]);

                if ($user->id != 1) { // if any user crated categories
                    $categories->orWhere(['id_user' => $user->id]);
                }

                $categories = $categories->orderBy(['id_user' => SORT_DESC, 'category_name' => SORT_ASC])->all();
                    
                $response['list'] = $categories;
                $response['categoryImagePath'] = Yii::$app->params['categoryImagePath'];
                $response['imagePath'] = Yii::$app->params['expenseImagePath']; ;

                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode($response);
            } else {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
    }

    public function actionCategoryDetails(){
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $request = Yii::$app->request;
                $data = json_decode($request->getRawBody(), true);
                $id = $data['id'];
                $query = (new Query())
                    ->select('*')
                    ->from('bt_category')
                    ->where(['bt_category.id_category' => $id]);

                $command = $query->createCommand();
                $data = $command->queryOne();
                $response['data'] = $data;
                $response['imagePath'] = Yii::$app->params['categoryImagePath'];
                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode($response);
            } else {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
    }

    public function actionDeleteCategory(){
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $event = ExpenseCategory::findOne($data['id']);

                if ($event) {

                    if ($event->delete()) {
                        Yii::$app->response->statusCode = 204; // No Content status code
                        return \yii\helpers\Json::encode(['message' => 'Event deleted successfully']);
                    } else {
                        Yii::$app->response->statusCode = 500; // Internal Server Error status code
                        return \yii\helpers\Json::encode(['error' => 'Failed to delete event']);
                    }
                } else {
                    Yii::$app->response->statusCode = 404; // Not Found status code
                    return \yii\helpers\Json::encode(['error' => 'Event not found']);
                }
            } else {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
    }



    public function actionCategory(){
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();

            if ($user) {
                $data = Yii::$app->request->post();
                $categoryId = Yii::$app->request->post('id_category'); // ID to determine add or update
                $category = $categoryId ? ExpenseCategory::findOne($categoryId) : new ExpenseCategory();

                if (!$category) {
                    Yii::$app->response->statusCode = 404;
                    return \yii\helpers\Json::encode(['error' => 'Category not found']);
                }

                // Assign data to category model
                $category->id_type = Yii::$app->request->post('id_type');
                $category->id_user = $user->id; // Default to current user
                // $category->parent = Yii::$app->request->post('parent');
                $category->category_name = Yii::$app->request->post('category_name');
                $category->category_description = Yii::$app->request->post('category_description', '');
                $category->category_image = Yii::$app->request->post('category_image', 'no-image.jpg'); // Optional
                $category->status = Yii::$app->request->post('status');

                // Handle the uploaded image
                $imageFile = UploadedFile::getInstanceByName('category_image');
                if ($imageFile) {
                    $uploadPath = Yii::getAlias('@webroot') . '/category/';
                    $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
                    $imageFile->saveAs($uploadPath . $imageName);

                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                    $fileExtensions = ['pdf'];
                    $imageFileExtension = strtolower($imageFile->extension);

                    if (in_array($imageFileExtension, $imageExtensions)) {

                        $image = Image::make($uploadPath . $imageName);
                        $image->encode('jpg', 70);
                        $compressedImageName = 'wplus_' . $imageName;
                        $image->save($uploadPath . $compressedImageName);
                        $category->category_image = $compressedImageName;
                    } else if (in_array($imageFileExtension, $fileExtensions)) {
                        $category->category_image = $imageName;
                    } else {
                        Yii::$app->response->statusCode = 500;
                        return \yii\helpers\Json::encode(['error' => 'Unsupported image type. Please upload a JPG, PNG, GIF, BMP, or WebP file.']);
                    }
                }
                // Save category data
                if ($category->save()) {
                    Yii::$app->response->statusCode = $categoryId ? 200 : 201;
                    return \yii\helpers\Json::encode($category);
                } else {
                    Yii::$app->response->statusCode = 422;
                    return \yii\helpers\Json::encode($category->getErrors());
                }
            } else {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['category','category-types', 'category-details', 'category-list', 'delete-category'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}
