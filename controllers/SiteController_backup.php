<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ForgotPasswordForm;
use app\models\ContactForm;
use app\models\Customer;

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


        // function x_week_range($date) {
            $date = date("Y/m/d");
            
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
        $categoriesQuery = Yii::$app->db->createCommand("select cat.category_name, exp.id_type, sum(exp.amount) as total from bt_expense exp, bt_category cat where cat.id_category=exp.id_category and exp.id_type=2 and exp.id_customer=".Yii::$app->user->id." and (date_of_transaction BETWEEN '".$firstDayOfMonth."' AND '".$lastDayOfMonth."') group by exp.id_category ORDER BY total DESC;");
        
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

        $this->layout = '@app/views/admin/applayout';
        return $this->render('dashboard',[
            'expenseTotal' => ($expenseTotal)? $expenseTotal : 0,   
            'expenditureTotal' => ($expenditureTotal)?$expenditureTotal:0,    
            'incomeTotal' => ($incomeTotal)?$incomeTotal:0,

            'dateWiseExpenses' => $dateWiseExpenses,
            'categories'=> $categories,
            'weekWiseExpenses' => $weekWiseExpenses,
            'monthWiseExpenses' => $monthWiseExpenses,
            'yearWiseExpenses' => $yearWiseExpenses,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->view->title = Yii::$app->name ." - Free Online Money Management";
        
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }
        
        return $this->render('index',[]);
    }

    
     /**
     * ForgotPassword action.
     *
     * @return Response|string
     */
    public function actionForgotPassword()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard']);
        }

        $model = new ForgotPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->fogotPassword() ) {
            return $this->redirect(['login']);
        }

        return $this->render('forgot-password', [
            'model' => $model,
        ]);
    }

     /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionSendEmail($to, $emailType)
    {

        // 1: Welcome Email
        // 2: Credentials 
        // 3: Email Verfication 
        // 4: Login  
        // 5: Forgot Password 
        // 6: Reset Password 
        // 7: Password Updated 

        //change this to your email. 
        $templateQuery = Yii::$app->db->createCommand("select * from bt_email_templates where id_email_template = 1");
        $templateData = $templateQuery->queryOne();
        $message = $templateData['email_template'];
        
        $emailQuery = Yii::$app->db->createCommand("select * from bt_email where id_email = ".$emailType);
        $emailData = $emailQuery->queryOne();
        $email = $emailData;
        
        // $from = $email['from'];
        $subject = $email['subject']; //." ".Yii::$app->user->identity->firstname."";
        $headers  = "From: ".$email['from_name']."<".$email['from_email'].">\r\n"; 
        $headers .= "Content-type: text/html\r\n";
        $headers .= "Cc: ".$email['cc_email'] . "\r\n";        
        $message = str_replace("{{email_content}}" , $email['email_content'], $message);        
        // mail($to, $subject, $message, $headers); 

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

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            // $to = Yii::$app->user->identity->email;
            // $this->actionSendEmail($to, '4');
            return $this->goBack();
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
        $this->layout = '@app/views/admin/applayout';

        $model = Customer::findOne(['id' => Yii::$app->user->id]) ;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Profile Updated successfully."); 
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['profile']);
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
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

        $model = new Customer();
        if ($this->request->isPost) {
            
            $data = Yii::$app->request->post();
            $to = $data['Customer']['email'];
            $this->actionSendEmail($to, '1');

            $model->id_customer_type = 3; // Register Always a User 
            
            $verification_code = random_bytes(20);
            $model->email_verification_code = bin2hex($verification_code);
            $model->email_verified = 0; 
            
            $digits = 4;
            $model->mobile_verification_code = (string)rand(pow(10, $digits-1), pow(10, $digits)-1); 
            $model->mobile_verified = 0;

            if ($model->load($this->request->post()) && $model->save()) {
                // exit("Control here2");
                // Send Welcome Email
            
                
                // Send Email Verification Link Email
                Yii::$app->session->setFlash('success', "Account created successfully."); 

                // Send Email Verification Link Email


                return $this->redirect(['login']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('register', [
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
}
