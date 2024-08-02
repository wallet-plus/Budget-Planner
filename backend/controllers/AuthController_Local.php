<?php

namespace app\controllers;
use yii\filters\auth\CompositeAuth;
use yii\filters\AccessControl;
use app\models\Customer;
use Yii;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ForgotPasswordForm;
use app\models\ResetPasswordForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class AuthController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // $behaviors['authenticator'] = [
        //     'class' => CompositeAuth::className(),
        //     // 'authMethods' => [
        //     //     HttpBearerAuth::className(),
        //     // ],

        // ];

        // $behaviors['verbs'] = [
        //     'class' => \yii\filters\VerbFilter::className(),
        //     'actions' => [
        //         'index' => ['get'],
        //         'view' => ['get'],
        //         'create' => ['post'],
        //         'update' => ['put'],
        //         'delete' => ['delete'],
        //         'login' => ['post'],
        //         'getPermissions' => ['get'],
        //     ],
        // ];

        // // remove authentication filter
        // $auth = $behaviors['authenticator'];
        // unset($behaviors['authenticator']);

        
        // // add CORS filter
        // $behaviors['corsFilter'] = [
        //     'class' => \yii\filters\Cors::class,
        //     'cors' => [
        //         'Origin' => ['http://localhost:4200', 'https://localhost:4200'], // replace with your domain(s)
        //         'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
        //         'Access-Control-Allow-Credentials' => true,
        //         'Access-Control-Request-Headers' => ['*'],
        //         'Access-Control-Max-Age' => 86400,
        //     ],
        // ];

        // // re-add authentication filter
        // $behaviors['authenticator'] = $auth;
        // // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        // $behaviors['authenticator']['except'] = ['options', 'login'];

        // // setup access
        // $behaviors['access'] = [
        //     'class' => AccessControl::className(),
        //     'only' => ['index', 'view', 'create', 'update', 'delete', 'getPermissions'], //only be applied to
        //     'rules' => [
        //         [
        //             'allow' => true,
        //             'actions' => ['index', 'view', 'create', 'update', 'delete', 'getPermissions'],
        //             'roles' => ['admin', 'manageStaffs'],
        //         ],
        //     ],
        // ];

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:4200', 'https://app.walletplus.in'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Max-Age' => 86400,
            ],
        ];

        return $behaviors;
    }

    public function actionSendEmail($to, $emailType, $extraParams)
    {
   

        // 1: Welcome Email
        // 2: Credentials 
        // 3: Email Verfication 

        $templateQuery = Yii::$app->db->createCommand("select * from bt_email_templates where id_email_template = 1");
        $templateData = $templateQuery->queryOne();

        $emailQuery = Yii::$app->db->createCommand("select * from bt_email where id_email = ".$emailType);
        $email = $emailQuery->queryOne();


        $from = $email['from_email']; 
        $fromName = $email['from_name'];
        $subject = $email['subject'];    
        
        $htmlContent = str_replace("template_email_content" , $email['email_content'], $templateData['email_template']);

        $subjectContent = '<tr> <td align="center" style="font-size:18px;color:#f90;font-family:helvetica,arial,sans-serif">'.$subject.'</td></tr>';
        $htmlContent = str_replace("template_subject_content" , $subjectContent, $htmlContent);

        if($emailType == '3'){ // 3: Email Verfication  
            $text = '<tr> <td align="center">
               <a href="https://walletplus.in/site/verifyemail?code='.$extraParams['code'].'&email='.$extraParams['email'].'" style="padding:10px 30px;font-family:helvetica,arial,sans-serif;color:#f90;font-size:16px;text-decoration:none;border:2px solid #f90;border-radius:8px">Verification Link</a>
             </td> </tr>
             <tr> <td height="50" style="font-size:1px">&nbsp;</td></tr>';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        } else if($emailType == '4'){ // 4: Login  
            $text = '<tr> <td align="center">
               <a href="https://walletplus.in/site/login" style="padding:10px 30px;font-family:helvetica,arial,sans-serif;color:#f90;font-size:16px;text-decoration:none;border:2px solid #f90;border-radius:8px">Check activity</a>
             </td> </tr>
             <tr> <td height="50" style="font-size:1px">&nbsp;</td></tr>';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        } else if($emailType == '5'){ // 5: Forgot Password   
            $text = '<tr> <td align="center">
               <a href="https://walletplus.in/site/reset-password?code='.$extraParams['code'].'&email='.$extraParams['email'].'" style="padding:10px 30px;font-family:helvetica,arial,sans-serif;color:#f90;font-size:16px;text-decoration:none;border:2px solid #f90;border-radius:8px">Reset Password</a>
             </td> </tr>
             <tr> <td height="50" style="font-size:1px">&nbsp;</td></tr>';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        } else{
            $text = '';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        }

           
        // 4: Login  
        // 5: Forgot Password 
        // 6: Reset Password 
        // 7: Password Updated 

        //change this to your email. 
        
        
        try {
            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
            $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
            $headers .= 'Cc: '.$email['cc_email'] . "\r\n";  
            if(mail($to, $subject, $htmlContent, $headers)){ 
                return true;
            }else{ 
                return false;
            }
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mailer->ErrorInfo}";
        }
    }




    public function actionRegister()
    {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);
        
        if($this->actionSendEmail($data['email'], '1', NULL)){
            // Check if the record already exists in the database
            $record = Customer::find()->where(['email' => $data['email'], 'username' => $data['phone']])->one();
            if ($record) {
                // If the record already exists, return an error response with a 400 status
                Yii::$app->response->statusCode = 400;
                return \yii\helpers\Json::encode(['error' => 'Record already exists']);
            } else {

                $verification_code = random_bytes(20);
                $genetated_verification_code = bin2hex($verification_code);
            

                // If the record does not exist, create a new record and return a success response with a 200 status
                $customer = new Customer();
                $customer->firstname = $data['name'];
                $customer->password = $data['password'];
                $customer->username = $data['phone'];
                $customer->phone = $data['phone'];
                $customer->email = $data['email'];
                $customer->email_verification_code = $genetated_verification_code;
                $customer->email_verified = 0;
                $customer->image = 'no-image.jpg'; 
                $customer->save();

                $tempArray = [];
                $tempArray['name'] = $data['name'];
                $tempArray['email'] = $data['email'];
                $tempArray['code'] = $genetated_verification_code;

                if($this->actionSendEmail($data['email'], '3', $tempArray)){
                    Yii::$app->response->statusCode = 200;
                    return \yii\helpers\Json::encode(['success' => 'Record added successfully']);
                }else{
                    Yii::$app->response->statusCode = 500;
                    return \yii\helpers\Json::encode(['success' => 'Something went wrong']);
                }
            }
        }
        return \yii\helpers\Json::encode($data);
    }

    public function actionLogin()
    {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);


        $user = Customer::find()->where(['email' => $data['email']])->one();
        if (!$user) {
            // If the user does not exist, return an error response with a 401 status
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Invalid email or password']);
        } else if ($user && Yii::$app->security->validatePassword($data['password'], $user->password)) {

            $token = Yii::$app->security->generateRandomString(32);
            $user->authKey = Yii::$app->security->generatePasswordHash($token);
            $user->save();

            $this->actionSendEmail($data['password'], 4, NULL);
            // Prepare the response data with the user details and the generated token

            $response = [
                'id' => $user->id,
                'email' => $user->email,
                'phone' => $user->phone,
                'name' => $user->firstname,
                'avatar' => null,
                'status' => null,
                'accessToken' => $token
            ];

            Yii::$app->response->statusCode = 200;
            return \yii\helpers\Json::encode($response);
        }
    }


    public function actionForgotPassword()
    {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);

        $user = Customer::find()->where(['email' => $data['email']])->one();
        if (!$user) {
            // If the user does not exist, return an error response with a 404 status
            Yii::$app->response->statusCode = 404;
            return \yii\helpers\Json::encode(['error' => 'User not found']);
        }

        // Generate a reset token
        $resetToken = Yii::$app->security->generateRandomString(32);
        $user->email_verification_code = $resetToken;
        $user->save();


        $tempArray = [];
        $tempArray['email'] = $data['email'];
        $tempArray['code'] = $resetToken;
        
        if($this->actionSendEmail($to, '5', $tempArray)){
            Yii::$app->response->statusCode = 200;
            return \yii\helpers\Json::encode(['message' => 'Password reset email sent']);
        }else{
            Yii::$app->response->statusCode = 500;
            return \yii\helpers\Json::encode(['error' => 'Failed to send password reset email']);
        }
        
    }



    public function actionResetPassword()
    {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);

        $user = Customer::find()->where(['email' => $data['email']])->one();
        if (!$user) {
            // If the user does not exist, return an error response with a 404 status
            Yii::$app->response->statusCode = 404;
            return \yii\helpers\Json::encode(['error' => 'User not found']);
        }

        if($data['password'] ==  $data['confirmpassword']){                
            $customerModel = Customer::findByEmail(['email' => $data['email']]) ;                
            $customerModel->password = Yii::$app->security->generatePasswordHash($data['ResetPasswordForm']['password']);
            $customerModel->save();    
            $tempArray = [];
            $to = $data['email'];
            if($this->actionSendEmail($to, '6', $tempArray)){       
                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode(['message' => 'Password updated successfully.']);
            }
        }else{

            Yii::$app->response->statusCode = 500;
            return \yii\helpers\Json::encode(['message' => 'Password are not matching.']);
        }
        
    }



    public function beforeAction($action)
    {
        if (in_array($action->id, ['login', 'register','forgot-password','reset-password'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

}
