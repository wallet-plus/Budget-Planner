<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ForgotPasswordForm;
use app\models\ResetPasswordForm;
use app\models\ContactForm;
use app\models\Customer;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDashboard()
    {


        
        // $this->layout = '@app/views/admin/applayout';
        // function x_week_range($date) {
            $date = '2024/05/20';// date("Y/m/d");
            
        // }

        /** Month wise */
        $timestamp    = strtotime($date);
        $firstDayOfMonth = date('Y-m-01', $timestamp);
        $lastDayOfMonth = date('Y-m-t', strtotime($date));
        
       if(Yii::$app->user->isGuest){
        return $this->redirect(['login']);
       }
        $this->view->title = 'Dashboard';

        // echo "select cat.category_name, exp.id_type, sum(exp.amount) as total from bt_expense exp, bt_category cat where cat.id_category=exp.id_category and exp.id_type=2 and exp.id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '2022-12-01' AND '2022-12-31') group by exp.id_category ORDER BY total DESC;";
        // exit;
        $categories = array();
        $categoriesQuery = Yii::$app->db->createCommand("select cat.category_name, cat.category_image, exp.id_type, sum(exp.amount) as total from bt_expense exp, bt_category cat where cat.id_category=exp.id_category and exp.id_type=2 and exp.id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."') group by exp.id_category ORDER BY total DESC;");
        
        $categoryResults = $categoriesQuery->queryAll();
        foreach( $categoryResults as $row ) {
            array_push($categories, $row);
        }

        $dateWiseExpenses = array();
        $dateExpQuery = Yii::$app->db->createCommand("SELECT sum(exp.amount) as amount , exp.date_of_transaction FROM `bt_expense` exp where exp.id_type=2 and exp.id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."') group by exp.date_of_transaction order by exp.date_of_transaction asc;
        ");
        
        $dateExpQueryResults = $dateExpQuery->queryAll();
        foreach( $dateExpQueryResults as $row ) {
            array_push($dateWiseExpenses, $row);
        }
        
        $command = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."')");
        
        

        $expenseTotalQuery = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE id_type=2 and id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."')");
        $expenseTotal = $expenseTotalQuery->queryScalar();


        $expenditureTotalQuery = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE id_type=1 and id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."')");
        $expenditureTotal = $expenditureTotalQuery->queryScalar();
        
        $incomeTotalQuery = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE id_type=3 and id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."')");
        $incomeTotal = $incomeTotalQuery->queryScalar();

        
        /** Year wise */
        $yearWiseExpenses = array();
        $yearWiseExpensesQuery = Yii::$app->db->createCommand("SELECT sum(exp.amount) as amount , exp.date_of_transaction FROM `bt_expense` exp where exp.id_type=2 and exp.id_customer=".Yii::$app->user->id." and YEAR(date_of_transaction) = YEAR(CURRENT_DATE()) group by exp.date_of_transaction order by exp.date_of_transaction asc;
        ");
        
        $yearWiseExpensesQueryResults = $yearWiseExpensesQuery->queryAll();
        foreach( $yearWiseExpensesQueryResults as $row ) {
            array_push($yearWiseExpenses, $row);
        }
        /** Year wise */


        

        $monthWiseExpenses = array();
        $monthWiseExpensesQuery = Yii::$app->db->createCommand("SELECT sum(exp.amount) as amount , exp.date_of_transaction FROM `bt_expense` exp where exp.id_type=2 and exp.id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."') group by exp.date_of_transaction order by exp.date_of_transaction asc;
        ");
        
        $monthWiseExpensesQueryResults = $monthWiseExpensesQuery->queryAll();
        foreach( $monthWiseExpensesQueryResults as $row ) {
            array_push($monthWiseExpenses, $row);
        }
        /** Month wise */


      


        /** Week wise */
        $start = (date('w', $timestamp) == 0) ? $timestamp : strtotime('last sunday', $timestamp);
        $weekStart = date('Y-m-d', $start);
        $weekEnd = date('Y-m-d', strtotime('next saturday', $start));

        $weekWiseExpenses = array();
        $weekWiseExpensesQuery = Yii::$app->db->createCommand("SELECT sum(exp.amount) as amount , exp.date_of_transaction FROM `bt_expense` exp where exp.id_type=2 and exp.id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '". $weekStart . "' AND '" . $weekEnd . "') group by exp.date_of_transaction order by exp.date_of_transaction asc; ");
        
        $weekWiseExpensesRes = $weekWiseExpensesQuery->queryAll();
        foreach( $weekWiseExpensesRes as $row ) {
            array_push($weekWiseExpenses, $row);
        }
        /** Week wise */

        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];


        $yearsQuery = Yii::$app->db->createCommand("
        SELECT DISTINCT YEAR(date_of_transaction) as year 
        FROM bt_expense 
        ORDER BY year DESC
        ")->queryAll();

        $years = array_column($yearsQuery, 'year');
        // print_r($years);
        // exit('control here');

        return $this->render('dashboard',[
            'expenseTotal' => ($expenseTotal)? $expenseTotal : 0,   
            'expenditureTotal' => ($expenditureTotal)?$expenditureTotal:0,    
            'incomeTotal' => ($incomeTotal)?$incomeTotal:0,

            'dateWiseExpenses' => $dateWiseExpenses,
            'categories'=> $categories,
            'weekWiseExpenses' => $weekWiseExpenses,
            'monthWiseExpenses' => $monthWiseExpenses,
            'yearWiseExpenses' => $yearWiseExpenses,

            'years' => $years,


        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }

        $this->view->title = Yii::$app->name .' - Free Financial Planner App for Expense Tracking and Budget Planning';
        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'Personal Finance, Expense Tracker, Budgeting App, Expense Management, Financial Planner'
        ]);
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => 'WalletPlus is a free financial planner app that helps you track your expenses, create budgets, and achieve your financial goals. With features like bill reminders, income and expense tracking, and custom savings goals, WalletPlus is the only app you need to get your money in shape. Download WalletPlus now and take control of your personal finances today.'
        ]);

        
        
        return $this->render('index');
    }

    


     /**
     * Login action.
     *
     * @return Response|string
     */
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
        if(Yii::$app->params['productionMode'] === true){
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
        } else {
            return true;
        }
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }

        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $to = Yii::$app->user->identity->email;
            if($this->actionSendEmail($to, 4, NULL));
            {
                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Profile Action
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['login']);
        }

        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];

        $model = Customer::findOne(['id' => Yii::$app->user->id]) ;

        $oldImage = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile !== null) {
                // Delete the old image if available
                if (!empty($oldImage)) {
                    $imagePath = Yii::getAlias('@webroot/users/') . $oldImage;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                 // Save the new image
                $imageName = Yii::$app->security->generateRandomString(16) . '.' . $model->imageFile->extension;
                $imagePath = Yii::getAlias('@webroot/users/') . $imageName;
                $model->imageFile->saveAs($imagePath);
                $model->image = $imageName;
                $model->imageFile = null;
                } else {
                    // Use the existing image if no new image was uploaded
                    $model->image = $oldImage;
                }

            if($model->save()){
                Yii::$app->session->setFlash('success', "Profile Updated successfully."); 
                return $this->redirect(['profile']);
            }
            
        }
        // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        //     Yii::$app->session->setFlash('success', "Profile Updated successfully."); 
        //     // return $this->redirect(['view', 'id' => $model->id]);
        //     return $this->redirect(['profile']);
        // }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    public function actionVerifyemail()
    {
        // $this->layout = '@app/views/admin/applayout';

        // echo Yii::$app->getRequest()->getQueryParam('code');

        if(Yii::$app->getRequest()->getQueryParam('code') && Yii::$app->getRequest()->getQueryParam('email')) {

            // echo "select * from bt_customer where email_verification_code = '".Yii::$app->getRequest()->getQueryParam('code')."' AND email='".Yii::$app->getRequest()->getQueryParam('email')."'";
            $checkUserStatus = Yii::$app->db->createCommand("select * from bt_customer where email_verification_code = '".Yii::$app->getRequest()->getQueryParam('code')."' AND email='".Yii::$app->getRequest()->getQueryParam('email')."'");
            $userData = $checkUserStatus->queryAll();

            // echo "<pre>";
            // print_r($userData);
            // echo $userData[0]['email_verified'];
            // exit;



            // $customer = Customer::findOne([
            //     'email' => Yii::$app->getRequest()->getQueryParam('email'),
            //     'email_verification_code' => Yii::$app->getRequest()->getQueryParam('code')
            //     ]) ;
            //     if($customer){

            //     }

            if(!$userData){
                Yii::$app->session->setFlash('error', "Something Went Wrong"); 
                return $this->redirect(['login']);
            }else if($userData[0]['email_verified'] == '0'){
                $customer = Customer::findOne(['email' => Yii::$app->getRequest()->getQueryParam('email')]) ;
                $customer->email_verified = 1;
                // $customer->email_verification_code = '';

                if ($customer->save()) {
                    if($this->actionSendEmail(Yii::$app->getRequest()->getQueryParam('email'), '8', NULL)){
                        Yii::$app->session->setFlash('success', "Email verfied Successfully!");
                        return $this->redirect(['login']);
                    }
                }
            }else if($userData[0]['email_verified'] == '1'){
                Yii::$app->session->setFlash('error', "Email is already Verified!");
                return $this->redirect(['login']); 
                // update and remove the code
            }
            
            
        }else{
            Yii::$app->session->setFlash('error', "Something Went Wrong"); 
            return $this->redirect(['login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }

        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];

        $model = new Customer();
        if ($this->request->isPost) {
            
            $data = Yii::$app->request->post();
            $to = $data['Customer']['email'];
            if($this->actionSendEmail($to, '1', NULL)){
                
                $model->id_customer_type = 3; // Register Always a User 
                
                $verification_code = random_bytes(20);
                $genetated_verification_code = bin2hex($verification_code);
                $model->email_verification_code = $genetated_verification_code ;
                $model->email_verified = 0; 
                $model->image = 'no-image.jpg'; 
                

                $tempArray = [];
                $tempArray['name'] = $data['Customer']['firstname'];
                $tempArray['email'] = $data['Customer']['email'];
                $tempArray['code'] = $genetated_verification_code;

                if($this->actionSendEmail($to, '3', $tempArray));


                
                // $digits = 4;
                // $model->mobile_verification_code = (string)rand(pow(10, $digits-1), pow(10, $digits)-1); 
                // $model->mobile_verified = 0;

                if ($model->load($this->request->post()) && $model->save()) {
                    // exit("Control here2");
                    // Send Welcome Email
                
                    
                    // Send Email Verification Link Email
                    Yii::$app->session->setFlash('success', "Welcome to WalletPlus! Your Account created successfully."); 
    
                    // Send Email Verification Link Email
    
                    return $this->redirect(['login']);
                }

            }




           
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }


         /**
     * ForgotPassword action.
     *
     * @return Response|string
     */
    public function actionForgotPassword()
    {

        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];
        
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }


        $model = new ForgotPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->fogotPassword() ) {
            $data = Yii::$app->request->post();

            $customerModel = Customer::findByEmail(['email' => $data['ForgotPasswordForm']['email']]) ;
            $verification_code = random_bytes(20);
            $genetated_verification_code = bin2hex($verification_code);
            $customerModel->email_verification_code = $genetated_verification_code ;
            $customerModel->save();

            $tempArray = [];
            // $tempArray['name'] = $data['ForgotPasswordForm']['username'];
            $tempArray['email'] = $data['ForgotPasswordForm']['email'];
            $tempArray['code'] = $genetated_verification_code;
            $to = $data['ForgotPasswordForm']['email'];
            if($this->actionSendEmail($to, '5', $tempArray)){
                Yii::$app->session->setFlash('success', "Reset password link sent to registered email successfully."); 
                return $this->redirect(['forgot-password']); 
            }
        }

        return $this->render('forgot-password', [
            'model' => $model,
        ]);
    }


         /**
     * ResetPassword action.
     *
     * @return Response|string
     */
    public function actionResetPassword()
    {
        // exit("actionResetPassword");
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }

        $model = new ResetPasswordForm();
        // && $model->fogotPassword()
        if ($model->load(Yii::$app->request->post()) ) {
            $data = Yii::$app->request->post();
            $getData = Yii::$app->request->get();

            if($data['ResetPasswordForm']['password'] ==  $data['ResetPasswordForm']['confirmpassword']){                
                $customerModel = Customer::findByEmail(['email' => $getData['email']]) ;                
                $customerModel->password = Yii::$app->security->generatePasswordHash($data['ResetPasswordForm']['password']);
                $customerModel->save();    
                $tempArray = [];
                $to = $getData['email'];
                if($this->actionSendEmail($to, '6', $tempArray)){
                    Yii::$app->session->setFlash('success', "Password updated successfully."); 
                    return $this->redirect(['login']); 
                }
            }else{
                Yii::$app->session->setFlash('error', "Password are not matching."); 
                    return $this->redirect(['reset-password', 'code' => $getData['code'], 'email' => $getData['email']]); 
            }
        }

        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {

            exit("control here");
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }

        return $this->render('about');
    }


    /**
     * Displays Budget Planner page.
     *
     * @return string
     */
    public function actionBudgetPlanner()
    {

        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }

        // Add a meta description for SEO
        $description = 'Discover our free online WalletPlus Budget Planner calculator to gain a better understanding of your money coming in and out, and how to improve your finances.';
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);

        // Add meta keywords for SEO
        $keywords = 'budget planner, budget calculator, financial management, expense tracking';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);

        return $this->render('budget-planner');
    }

    public function actionAjax()
    {
        // if(isset(Yii::$app->request->post('test'))){
            $test = "Ajax Worked!";
        //     // do your query stuff here
        // }else{
        //     $test = "Ajax failed";
        //     // do your query stuff here
        // }

        // return Json    
        return \yii\helpers\Json::encode($test);
    }


    public function beforeAction($action)
    {
        if (in_array($action->id, ['ajax'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionDownloadImage($filename)
    {
        $path = Yii::getAlias('@webroot') . '/expenses/' . $filename;
        if (file_exists($path)) {
            Yii::$app->response->sendFile($path);
        } else {
            throw new NotFoundHttpException("The file '{$filename}' does not exist.");
        }
    }


    /**
     * Personal Finance action.
     *
     * @return Response
     */
    public function actionPersonalFinance()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }
        
        return $this->render('personal-finance');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionSupport()
    {
        // if (!Yii::$app->user->isGuest) {
        //     $this->redirect(['dashboard']);
        // }

        $themeName =Yii::$app->params['currentTheme'];
        $this->layout = '@app/themes/'.$themeName.'/views/admin/applayout';
        $theme = Yii::$app->view->theme;
        $theme->pathMap = ['@app/views' => '@app/themes/'.$themeName.'/views'];

        return $this->render('support');
    }

}
