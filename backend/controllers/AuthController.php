<?php

namespace app\controllers;
use yii\filters\auth\CompositeAuth;
use yii\filters\AccessControl;
use app\models\Customer;
use app\models\CustomerType;

use Yii;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ForgotPasswordForm;
use app\models\ResetPasswordForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class AuthController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:4200', 'https://secure.walletplus.in'],
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
        // 3: Email Verification 
        // 4: Login  
        // 5: Forgot Password 
        // 6: Reset Password 
        // 7: Password Updated 

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
               <a href="https://walletplus.in/auth/verifyemail?code='.$extraParams['code'].'&email='.$extraParams['email'].'" style="padding:10px 30px;font-family:helvetica,arial,sans-serif;color:#f90;font-size:16px;text-decoration:none;border:2px solid #f90;border-radius:8px">Verification Link</a>
             </td> </tr>
             <tr> <td height="50" style="font-size:1px">&nbsp;</td></tr>';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        } else if($emailType == '4'){ // 4: Login  
            $text = '<tr> <td align="center">
               <a href="https://secure.walletplus.in" style="padding:10px 30px;font-family:helvetica,arial,sans-serif;color:#f90;font-size:16px;text-decoration:none;border:2px solid #f90;border-radius:8px">Check activity</a>
             </td> </tr>
             <tr> <td height="50" style="font-size:1px">&nbsp;</td></tr>';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        } else if($emailType == '5'){ // 5: Forgot Password   
            $text = '<tr> <td align="center">
               <a href="https://secure.walletplus.in/resetpassword?code='.$extraParams['code'].'&email='.$extraParams['email'].'" style="padding:10px 30px;font-family:helvetica,arial,sans-serif;color:#f90;font-size:16px;text-decoration:none;border:2px solid #f90;border-radius:8px">Reset Password</a>
             </td> </tr>
             <tr> <td height="50" style="font-size:1px">&nbsp;</td></tr>';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        } else{
            $text = '';
            $htmlContent = str_replace("template_button_content" , $text, $htmlContent);
        }

        if(Yii::$app->params['productionMode']){
            try {
                // Set content-type header for sending HTML email 
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    
                if($email['cc_email']){
                    $headers .= 'Cc: '.$email['cc_email'] . "\r\n";  
                }
               
                if(mail($to, $subject, $htmlContent, $headers)){ 
                    return true;
                }else{ 
                    return false;
                }
            } catch (Exception $e) {
                echo "Email could not be sent. Error: {$mailer->ErrorInfo}";
            }
        }else{
            return true;
        }
    }




    public function actionRegister()
    {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);
        
        if($this->actionSendEmail($data['email'], '1', NULL)){


            $checkPhone = Customer::find()->where(['username' => $data['phone']])->one();
            if ($checkPhone) {
                Yii::$app->response->statusCode = 400;
                return \yii\helpers\Json::encode( [
                        'key' => 'phone',
                        'message' => 'Phone Number already exists',
                ]);
            }

            $checkEmail = Customer::find()->where(['email' => $data['email']])->one();
            if ($checkEmail) {
                Yii::$app->response->statusCode = 400;
                return \yii\helpers\Json::encode( [
                    'key' => 'email',
                    'message' => 'Email already exists',
                ]);
            }
            
            if(!$checkPhone  && !$checkEmail){
                $verification_code = random_bytes(20);
                $genetated_verification_code = bin2hex($verification_code);
            
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

    public function actionLogout()
    {
        $headers = Yii::$app->request->headers; 
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $user->authKey = null;
                $user->save(false);
                Yii::$app->response->statusCode = 200;
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'message' => 'Logout successfully.',
                ];
            } else {
                Yii::$app->response->statusCode = 401;
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'error' => 'Unauthorized',
                    'message' => 'UnAuthorized User.',
                ];
            }
        } else {
            Yii::$app->response->statusCode = 401;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'error' => 'Unauthorized',
                'message' => 'UnAuthorized user',
            ];
        }
    }

    public function actionLogin() {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);

        $user = Customer::find()->where(['phone' => $data['phone']])->one();
        if (!$user) {
            Yii::$app->response->statusCode = 400;
            return \yii\helpers\Json::encode( [
                    'key' => 'phone',
                    'message' => 'Invalid phone number or password',
            ]);
        } else if ($user->active == '1') {
            Yii::$app->response->statusCode = 400;
            return \yii\helpers\Json::encode( [
                    'key' => 'email',
                    'message' => 'Your Account Deactivated',
            ]);
        } else if ($user && Yii::$app->security->validatePassword($data['password'], $user->password)) {
            $token = Yii::$app->security->generateRandomString(32);
            $user->authKey = Yii::$app->security->generatePasswordHash($token);
            $user->save();

            $customerType = CustomerType::find()->where(['id_customer_type' => $user->id_customer_type])->one();

            $response = [
                'id' => $user->id,
                'customerType' => $customerType->name,
                'customerTypeId' => $user->id_customer_type,
                'email' => $user->email,
                'phone' => $user->phone,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'image' => $user->image,
                'imagePath' => Yii::$app->params['userImagePath'],
                'status' => null,
                'accessToken' => $user->authKey

            ];
            Yii::$app->response->statusCode = 200;
            return \yii\helpers\Json::encode($response);
        }else{
            Yii::$app->response->statusCode = 400;
            return \yii\helpers\Json::encode( [
                    'key' => 'password',
                    'message' => 'Invalid phone number or password',
            ]);
        }
    }


    public function actionForgotPassword()
    {
        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);

        $user = Customer::find()->where(['email' => $data['email']])->one();
        if (!$user) {
            Yii::$app->response->statusCode = 404;
            return \yii\helpers\Json::encode(['error' => 'Email not found']);
        }

        // Generate a reset token
        $resetToken = Yii::$app->security->generateRandomString(32);
        $user->email_verification_code = $resetToken;
        $user->save();

        $tempArray = [];
        $tempArray['email'] = $data['email'];
        $tempArray['code'] = $resetToken;
        
        if($this->actionSendEmail($data['email'], '5', $tempArray)){
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
        // print_r($data);
        // exit("control here");

        $user = Customer::find()->where(['email' => $data['email']])->one();
        if (!$user) {
            // If the user does not exist, return an error response with a 404 status
            Yii::$app->response->statusCode = 404;
            return \yii\helpers\Json::encode(['error' => 'User not found']);
        }

        if($data['password'] ==  $data['confirmPassword']){                
            $customerModel = Customer::findByEmail(['email' => $data['email']]) ;                
            $customerModel->password = Yii::$app->security->generatePasswordHash($data['password']);
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


    

    public function actionSaveProfile()
    { 

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if($user){

                $oldImageName = $user->image;
            
                $user->firstname = Yii::$app->request->post('firstname');
                $user->lastname = Yii::$app->request->post('lastname');
                $user->date_of_birth = Yii::$app->request->post('date_of_birth');
                // $user->username = Yii::$app->request->post('username');
                // $user->otp = Yii::$app->request->post('otp');
                $user->phone = Yii::$app->request->post('phone');
                $user->gender = Yii::$app->request->post('gender');

                $user->active = Yii::$app->request->post('accountDeactivation');
                $user->offline_access = Yii::$app->request->post('enableOfflineAccess');
                $user->email_notification = Yii::$app->request->post('emailNotification');



                // $user->email = Yii::$app->request->post('email');

                if(Yii::$app->request->post('password')){
                    $user->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('password'));
                }
                
                $imageFile = UploadedFile::getInstanceByName('image');
                if ($imageFile) {
                    
                    $uploadPath = Yii::getAlias('@webroot') . '/users/';
                    $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
                    $imageFile->saveAs($uploadPath . $imageName);
                    $user->image = $imageName;
                    // $user->image = $imageName;   
                    // $image = Image::make($uploadPath . $imageName);
                    // $image->encode('jpg', 70); // Compress the image to JPEG format with 70% quality
                    // $image->fit(200, 200);
                    // $compressedImageName = 'wplus_' . $imageName;
                    // $image->save($uploadPath . $compressedImageName);
                    // $user->image = $compressedImageName;

                    if ($oldImageName) {
                        $oldImagePath = $uploadPath . $oldImageName;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }

                if ($user->save()) {   
                    
                    $customerType = CustomerType::find()->where(['id_customer_type' => $user->id_customer_type])->one();


                   

                    $response = [
                        // 'authKey' =>$user->date_updated ,
                        // 'date_created' => $user->date_updated ,
                        // 'date_updated' => $user->date_updated ,

                        'accessToken' => $user->authKey ,
                        'customerType' => $customerType->name,
                        'customerTypeId' => $user->id_customer_type,
                        
                        'email_verification_code' => $user->email_verification_code,
                        'email_verified' => $user->email_verified,
                        'firstname' => $user->firstname,
                        'id' => $user->id,
                        'id_customer_type' => $user->id_customer_type,
                        'image' => $user->image,
                       
                        'lastname' => $user->lastname,
                       
                        'phone' => $user->phone,
                       
                        'otp' => $user->otp,
                        'gender' => $user->gender,
                        'username' => $user->username,
                        'status' => $user->active, 
                        // 'offline_access' => $user->offline_access ,
                        // 'email_notification' => $user->email_notification,
                        // 'mobile_verification_code' => $user->mobile_verification_code,
                        // 'mobile_verified' => $user->mobile_verified,
                        // 'date_of_birth'=> $date_of_birth
                        // 'ipaddress' => $user->ipaddress,
                    ];

                    // $response['userData'] = $user;
                    $response['imagePath'] = Yii::$app->params['userImagePath'];
                    Yii::$app->response->statusCode = 200;
                    return \yii\helpers\Json::encode($response);
                } else {
                    Yii::$app->response->statusCode = 500;
                    return \yii\helpers\Json::encode(['error' => 'Failed to update profile']);
                }
            }
            
            if (!$user) {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
    }
    
    public function actionProfile()
    { 
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $response['userData'] = Customer::find()->where(['authKey' => $token])->one();
            $response['imagePath'] = Yii::$app->params['userImagePath'];
            Yii::$app->response->statusCode = 200;
            return \yii\helpers\Json::encode($response); 
            
            if (!$user) {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
        
    }


    public function actionVerifyemail()
    {
        $code = Yii::$app->getRequest()->getQueryParam('code');
        $email = Yii::$app->getRequest()->getQueryParam('email');

        $successMessage = '';

        if ($code && $email) {
            $userData = Yii::$app->db
                ->createCommand("SELECT * FROM bt_customer WHERE email_verification_code = '$code' AND email = '$email'")
                ->queryAll();
            if (!$userData) {
                $successMessage = "Something Went Wrong!";
            } else if ($userData[0]['email_verified'] == 0) {
                $customer = Customer::findOne(['email' => $email]);
                $customer->email_verified = 1;
                if ($customer->save() && $this->actionSendEmail($email, '8', null)) {
                    $successMessage = "Email verified Successfully!";
                }
            } else if ($userData[0]['email_verified'] == '1') {
                $successMessage = "Email is already Verified!";
            }
        } else {
            $successMessage = "Something Went Wrong!";
        }

        $encodedSuccessMessage = urlencode($successMessage);
        $redirectUrl = "https://secure.walletplus.in/signin?status={$encodedSuccessMessage}";

        Yii::$app->response->redirect($redirectUrl)->send();
        Yii::$app->end();
    }


    public function actionUsers()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();

            if($user){
                $users = Customer::find()->orderBy(['id' => SORT_DESC])->all();
                $response['list'] = $users;
                $response['userImagePath'] = Yii::$app->params['userImagePath'];
                $response['imagePath'] = Yii::$app->params['userImagePath'];

                
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


    public function actionUserDetails()
    { 
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();

            if($user){
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);
                $userId = $data['id'];
                $response['userData'] = Customer::find()->where(['id' => $userId])->one();
                $response['imagePath'] = Yii::$app->params['userImagePath'];
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


    public function actionCreateUser()
    {
        $headers = Yii::$app->request->headers;
        
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $authUser = Customer::find()->where(['authKey' => $token])->one();
    
            if ($authUser) {
                // Check if we are updating an existing user or adding a new one
                $userId = Yii::$app->request->post('id');
                if ($userId) {
                    $userData = Customer::find()->where(['id' => $userId])->one();
                } else {
                    $userData = new Customer(); // New user for creation
                }
    
                if (!$userData) {
                    Yii::$app->response->statusCode = 500;
                    return \yii\helpers\Json::encode(['error' => 'User Not Found']);
                }
    
                // If the user is found or is new, update/add user data
                $oldImageName = $userData->image;
    
                // Update user data from the request
                $userData->firstname = Yii::$app->request->post('firstname');
                $userData->lastname = Yii::$app->request->post('lastname');
                $userData->phone = Yii::$app->request->post('phone');
                $userData->gender = Yii::$app->request->post('gender');
                $userData->active = Yii::$app->request->post('accountDeactivation');
                $userData->offline_access = Yii::$app->request->post('enableOfflineAccess');
                $userData->email_notification = Yii::$app->request->post('emailNotification');
    
                // Only set password if it's provided in the request
                if (Yii::$app->request->post('password')) {
                    $userData->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('password'));
                }
    
                // Handle image upload
                $imageFile = UploadedFile::getInstanceByName('image');
                if ($imageFile) {
                    $uploadPath = Yii::getAlias('@webroot') . '/users/';
                    $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
                    $imageFile->saveAs($uploadPath . $imageName);
                    $userData->image = $imageName;
    
                    // Remove old image if exists
                    if ($oldImageName) {
                        $oldImagePath = $uploadPath . $oldImageName;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
    
                // Save the user data
                if ($userData->save()) {
                    $response = [
                        'email_verification_code' => $userData->email_verification_code,
                        'email_verified' => $userData->email_verified,
                        'firstname' => $userData->firstname,
                        'id' => $userData->id,
                        'id_customer_type' => $userData->id_customer_type,
                        'image' => $userData->image,
                        'ipaddress' => $userData->ipaddress,
                        'lastname' => $userData->lastname,
                        'mobile_verification_code' => $userData->mobile_verification_code,
                        'mobile_verified' => $userData->mobile_verified,
                        'otp' => $userData->otp,
                        'gender' => $userData->gender,
                        'phone' => $userData->phone,
                        'username' => $userData->username,
                        'active' => $userData->active,
                        'offline_access' => $userData->offline_access,
                        'email_notification' => $userData->email_notification,
                    ];
    
                    $response['imagePath'] = Yii::$app->params['userImagePath'];
                    Yii::$app->response->statusCode = 200;
                    return \yii\helpers\Json::encode($response);
                } else {
                    Yii::$app->response->statusCode = 500;
                    return \yii\helpers\Json::encode(['error' => 'Failed to save user data']);
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

    public function actionUpdateUser()
    {
        $headers = Yii::$app->request->headers;

        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $authUser = Customer::find()->where(['authKey' => $token])->one();

            if ($authUser) {
                // Get the user ID from the request
                $userId = Yii::$app->request->post('id');

                // Find the user to update
                $userData = Customer::find()->where(['id' => $userId])->one();
                if (!$userData) {
                    Yii::$app->response->statusCode = 404;
                    return \yii\helpers\Json::encode(['error' => 'User Not Found']);
                }

                $userData->firstname = Yii::$app->request->post('firstname');
                $userData->lastname = Yii::$app->request->post('lastname');
                $userData->phone = Yii::$app->request->post('phone');
                $userData->gender = Yii::$app->request->post('gender');

                // Only set password if it's provided in the request
                if (Yii::$app->request->post('password')) {
                    $userData->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('password'));
                }

                // Store the old image name
                // $oldImageName = $userData->image;

                // Update user data from the request
                
                // $userData->phone = Yii::$app->request->post('phone', $userData->phone);
                // $userData->gender = Yii::$app->request->post('gender', $userData->gender);
                // $userData->active = Yii::$app->request->post('accountDeactivation', $userData->active);
                // $userData->offline_access = Yii::$app->request->post('enableOfflineAccess', $userData->offline_access);
                // $userData->email_notification = Yii::$app->request->post('emailNotification', $userData->email_notification);

                

                // Handle image upload
                // $imageFile = UploadedFile::getInstanceByName('image');
                // if ($imageFile) {
                //     $uploadPath = Yii::getAlias('@webroot') . '/users/';
                //     $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
                //     $imageFile->saveAs($uploadPath . $imageName);
                //     $userData->image = $imageName;

                //     // Remove old image if exists
                //     if ($oldImageName) {
                //         $oldImagePath = $uploadPath . $oldImageName;
                //         if (file_exists($oldImagePath)) {
                //             unlink($oldImagePath);
                //         }
                //     }
                // }

                // Save the user data
                if ($userData->save()) {
                    $response = [
                        'email_verification_code' => $userData->email_verification_code,
                        'email_verified' => $userData->email_verified,
                        'firstname' => $userData->firstname,
                        'id' => $userData->id,
                        'id_customer_type' => $userData->id_customer_type,
                        'image' => $userData->image,
                        'ipaddress' => $userData->ipaddress,
                        'lastname' => $userData->lastname,
                        'mobile_verification_code' => $userData->mobile_verification_code,
                        'mobile_verified' => $userData->mobile_verified,
                        'otp' => $userData->otp,
                        'gender' => $userData->gender,
                        'phone' => $userData->phone,
                        'username' => $userData->username,
                        'active' => $userData->active,
                        'offline_access' => $userData->offline_access,
                        'email_notification' => $userData->email_notification,
                    ];

                    $response['imagePath'] = Yii::$app->params['userImagePath'];
                    Yii::$app->response->statusCode = 200;
                    return \yii\helpers\Json::encode($response);
                } else {
                    Yii::$app->response->statusCode = 500;
                    return \yii\helpers\Json::encode(['error' => 'Failed to update user data']);
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

    public function actionDeleteUser() {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
           
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
           
            if ($user) {
                $userId = Yii::$app->request->post('id');
                $customer = Customer::findOne($userId);
                if ($customer) {
                    if ($customer->delete()) {
                        Yii::$app->response->statusCode = 204; // No Content status code
                        return \yii\helpers\Json::encode(['message' => 'User deleted successfully']);
                    } else {
                        Yii::$app->response->statusCode = 500; // Internal Server Error status code
                        return \yii\helpers\Json::encode(['error' => 'Failed to delete User']);
                    }
                } else {
                    Yii::$app->response->statusCode = 404; // Not Found status code
                    return \yii\helpers\Json::encode(['error' => 'User not found']);
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


    public function beforeAction($action)
    {
        if (in_array($action->id, ['update-user','create-user','delete-user', 'user-details', 'users', 'login', 'register','forgot-password','reset-password', 'profile', 'save-profile','verifyemail'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

}
