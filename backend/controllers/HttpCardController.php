<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use app\models\Customer;
use app\models\Cards;
use yii\web\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class HttpCardController extends \yii\web\Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $headers = Yii::$app->request->headers;
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:4200', 'https://secure.walletplus.in', 'https://walletplus.in'],
                'Access-Control-Request-Method' => ['FETCH', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }

    private function getAuthorizedUser()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            return Customer::find()->where(['authKey' => $token])->one();
        }
        return null;
    }

    public function actionCards()
    {

        $user = $this->getAuthorizedUser();
        if ($user) {

            $cards = Cards::find()
                ->where(['id_customer' => $user->id])
                ->orderBy(['id_card' => SORT_DESC])
                ->all();

            $response = [
                'list' => $cards,
                'cardsImagePath' => Yii::$app->params['cardImagePath'],
            ];
            Yii::$app->response->statusCode = 200;
            return \yii\helpers\Json::encode($response);
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionAddCard()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {
            $newCard = new Cards();  // Create a new card instance
            $newCard->name = Yii::$app->request->post('name');
            $newCard->id_customer = $user->id;
            // $newCard->status = Yii::$app->request->post('status');
    
             // Handle the file upload and image processing if needed
             $imageFile = UploadedFile::getInstanceByName('image');
             if ($imageFile) {
                 $uploadPath = Yii::getAlias('@webroot') . '/cards/';
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
                     $newCard->image = $compressedImageName;
                 } elseif (in_array($imageFileExtension, $fileExtensions)) {
                     $newCard->image = $imageName;
                 } else {
                     Yii::$app->response->statusCode = 500;
                     throw new \yii\web\HttpException(500, 'Unsupported image type. Please upload a JPG, PNG, GIF, BMP, or WebP file.');
                 }
             }
 
    
            // Save the new card
            if ($newCard->save()) {
                Yii::$app->response->statusCode = 201; // Created
                return \yii\helpers\Json::encode($newCard); // Return the new card
            } else {
                Yii::$app->response->statusCode = 422;
                return \yii\helpers\Json::encode($newCard->getErrors()); // Validation errors
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }
    

    public function actionUpdateCard()
{
    $user = $this->getAuthorizedUser();
    if ($user) {
        $cardId = Yii::$app->request->post('id');
        $card = Cards::findOne($cardId);

        if ($card) {
            $card->name = Yii::$app->request->post('name');
            $card->id_customer = $user->id;
            // $card->status = Yii::$app->request->post('status');

            // Handle the file upload and image processing if needed
            $imageFile = UploadedFile::getInstanceByName('image');
            if ($imageFile) {
                $uploadPath = Yii::getAlias('@webroot') . '/cards/';
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
                    $card->image = $compressedImageName;
                } elseif (in_array($imageFileExtension, $fileExtensions)) {
                    $card->image = $imageName;
                } else {
                    Yii::$app->response->statusCode = 500;
                    throw new \yii\web\HttpException(500, 'Unsupported image type. Please upload a JPG, PNG, GIF, BMP, or WebP file.');
                }
            }

            // Save the updated card
            if ($card->save()) {
                Yii::$app->response->statusCode = 200; // OK
                return \yii\helpers\Json::encode($card); // Return updated card
            } else {
                Yii::$app->response->statusCode = 422;
                return \yii\helpers\Json::encode($card->getErrors()); // Validation errors
            }
        } else {
            Yii::$app->response->statusCode = 404;
            return \yii\helpers\Json::encode(['error' => 'Card not found']);
        }
    } else {
        Yii::$app->response->statusCode = 401;
        return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
    }
}


    public function actionDelete()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {
            $id = Yii::$app->request->post('id');

            $card = Cards::findOne($id);

            if ($card) {

                if ($card->delete()) {
                    Yii::$app->response->statusCode = 204; // No Content status code
                    return \yii\helpers\Json::encode(['message' => 'Card deleted successfully']);
                } else {
                    Yii::$app->response->statusCode = 500; // Internal Server Error status code
                    return \yii\helpers\Json::encode(['error' => 'Failed to delete card']);
                }
            } else {
                Yii::$app->response->statusCode = 404; // Not Found status code
                return \yii\helpers\Json::encode(['error' => 'Card not found']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionGet()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {

            $id = Yii::$app->request->post('id');
            $query = (new Query())
                ->select('*')
                ->from('bt_cards')
                ->where(['bt_cards.id_customer' => $user->id])
                ->where(['bt_cards.id_card' => $id]);

            $command = $query->createCommand();
            $cardData = $command->queryOne();


            $response = [
                'data' => $cardData,
                'imagePath' => Yii::$app->params['cardImagePath'],

            ];
            Yii::$app->response->statusCode = 200;
            return \yii\helpers\Json::encode($response);
        }
    }







    public function beforeAction($action)
    {
        if (in_array($action->id, [
            'cards',
            'delete',
            'get',
            'add-card',
            'update-card',
            'members-list',
            'delete-member'
        ])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}
