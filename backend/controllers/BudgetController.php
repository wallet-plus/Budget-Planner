<?php

namespace app\controllers;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\AccessControl;
use app\models\Expense;
use app\models\ExpenseMember;
use app\models\Member;
use app\models\ExpenseCategory;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use DateTime;
use Firebase\JWT\JWT;
use yii\db\Query;
use yii\web\UploadedFile;
use app\models\Customer;
use app\models\Events;
use app\models\EventMember;
use yii\web\Response;
use Intervention\Image\ImageManagerStatic as Image;

class BudgetController extends \yii\web\Controller
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
                'Access-Control-Request-Method' => ['FETCH', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
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

        $templateQuery = Yii::$app->db->createCommand("select * from bt_email_templates where id_email_template = 3");
        $templateData = $templateQuery->queryOne();

        // print_r(templateData);
        // exit;


        $emailQuery = Yii::$app->db->createCommand("select * from bt_email where id_email = " . $emailType);
        $email = $emailQuery->queryOne();



        $from = $email['from_email'];
        $fromName = $email['from_name'];
        $subject = $email['subject'];

        $htmlContent = str_replace("template_email_content", $email['email_content'], $templateData['email_template']);

        $subjectContent = '<tr> <td align="center" style="font-size:18px;color:#f90;font-family:helvetica,arial,sans-serif">' . $subject . '</td></tr>';
        $htmlContent = str_replace("template_subject_content", $subjectContent, $htmlContent);

        $text = 'report';
        $htmlContent = str_replace("template_button_content", $text, $htmlContent);


        try {
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";

            if ($email['cc_email']) {
                $headers .= 'Cc: ' . $email['cc_email'] . "\r\n";
            }


            if (mail($to, $subject, $htmlContent, $headers)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mailer->ErrorInfo}";
        }
    }



    public function actionSendReport()
    {
        $this->actionSendEmail('abdulfareed.md@gmail.com', '9', NULL);
    }

    public function actionGetList()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {

                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $query = (new Query())
                    ->select('*')
                    ->from('bt_expense')
                    ->leftJoin('bt_category category', 'category.id_category = bt_expense.id_category')
                    ->leftJoin('bt_type type', 'type.id_type = category.id_type');

                if ($data['type'] == 0) {
                    $query->where(['bt_expense.id_customer' => $user->id]);
                } else {
                    $query->where(['type.id_type' => $data['type'], 'bt_expense.id_customer' => $user->id]);

                    if (isset($data['queryParam'])) {
                        $query->andWhere([
                            'OR',
                            ['like', 'bt_expense.expense_name', $data['queryParam']],
                            ['like', 'bt_expense.description', $data['queryParam']]
                        ]);
                    }
                    if (isset($data['category'])) {
                        $query->andWhere(['bt_expense.id_category' => $data['category']]);
                    }
                }
                $query->orderBy(['bt_expense.id_expense' => SORT_DESC]);



                $command = $query->createCommand();
                $list = $command->queryAll();
                $response['list'] = $list;
                $response['categoryImagePath'] = 'https://walletplus.in/category/';
                $response['imagePath'] = 'https://walletplus.in/expenses/';
                $response['expenseImagePath'] = 'https://walletplus.in/expenses/';
                $response['userImagePath'] = 'https://walletplus.in/users/';


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


    public function actionGet()
    {
        // exit("here");
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $id = Yii::$app->request->get('id');
                $query = (new Query())
                    ->select('*')
                    ->from('bt_expense')
                    ->where(['bt_expense.id_expense' => $id]);

                $command = $query->createCommand();
                $data = $command->queryOne();

                 // Query to get the associated members
                    $membersQuery = (new Query())
                    ->select('bt_member.id_member, bt_member.firstname, bt_member.lastname')
                    ->from('bt_expense_member')
                    ->leftJoin('bt_member', 'bt_expense_member.id_member = bt_member.id_member')
                    ->where(['bt_expense_member.id_expense' => $id]);

                $membersCommand = $membersQuery->createCommand();
                $membersData = $membersCommand->queryAll();

                $response['data'] = $data;
                $response['members'] = $membersData;
                $response['imagePath'] = 'http://localhost/walletplus/expenses/';
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

    public function actionSuggestion()
    {

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                if (!empty($data['param'])) {
                    $filteredExpenses = Expense::find()
                        ->select(['expense_name', 'id_category'])
                        ->where(['LIKE', 'expense_name', $data['param'] . '%', false])
                        ->asArray() // Retrieve the results as an array
                        ->all();    // Retrieve all matching rows

                    // $filteredExpenses = array_unique($filteredExpenses, SORT_REGULAR);
                    $uniqueExpenses = [];
                    foreach ($filteredExpenses as $expense) {
                        $expenseName = $expense['expense_name'];
                        if (!isset($uniqueExpenses[$expenseName])) {
                            $uniqueExpenses[$expenseName] = $expense;
                        }
                    }
                    $filteredExpenses = array_values($uniqueExpenses);

                    Yii::$app->response->format = Response::FORMAT_JSON;
                    Yii::$app->response->statusCode = 200;
                    return $filteredExpenses;
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    Yii::$app->response->statusCode = 400;
                    return ['error' => 'Missing or empty parameter'];
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

    public function actionStatistics()
    {

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $userId =  $user->id;
                $date = date("Y/m/d");

                /** Month wise */
                $timestamp    = strtotime($date);
                $startDate = $data['startDate'];
                $endDate = $data['endDate'];

                $categories = array();
                // $categoriesQuery = Yii::$app->db->createCommand("select cat.category_name, exp.id_type, sum(exp.amount) as total from bt_expense exp, bt_category cat where cat.id_category=exp.id_category and exp.id_type=2 and exp.id_customer=".$userId." and (date_of_transaction BETWEEN '".$startDate."' AND '".$endDate."') group by exp.id_category ORDER BY total DESC;");

                $categoriesQuery = Yii::$app->db->createCommand("
                    SELECT 
                        cat.category_name, 
                        cat.category_image, 
                        exp.id_type, 
                        SUM(exp.amount) AS total 
                    FROM bt_expense exp
                    JOIN bt_category cat ON exp.id_category = cat.id_category
                    WHERE exp.id_type = 2 
                    AND exp.id_customer = " . $userId . " 
                    AND (date_of_transaction BETWEEN '" . $startDate . "' AND '" . $endDate . "') 
                    GROUP BY exp.id_category 
                    ORDER BY total DESC;
                ");

                $categoryResults = $categoriesQuery->queryAll();
                foreach ($categoryResults as $row) {
                    array_push($categories, $row);
                }



                $command = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE (date_of_transaction BETWEEN '" . $startDate . "' AND '" . $endDate . "')");


                $expenseTotalQuery = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE id_type=2 and id_customer=" . $userId . " and (date_of_transaction BETWEEN '" . $startDate . "' AND '" . $endDate . "')");
                $expenseTotal = $expenseTotalQuery->queryScalar();


                $incomeTotalQuery = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE id_type=3 and id_customer=" . $userId . " and (date_of_transaction BETWEEN '" . $startDate . "' AND '" . $endDate . "')");
                $incomeTotal = $incomeTotalQuery->queryScalar();


                $expenseData = array();
                $expenseDataQuery = Yii::$app->db->createCommand("SELECT sum(exp.amount) as amount , exp.date_of_transaction FROM `bt_expense` exp where exp.id_type=2 and exp.id_customer=" . $userId . " and (date_of_transaction BETWEEN '" . $startDate . "' AND '" . $endDate . "') group by exp.date_of_transaction order by exp.date_of_transaction asc;
                ");

                $expenseDataQueryResults = $expenseDataQuery->queryAll();
                foreach ($expenseDataQueryResults as $row) {
                    array_push($expenseData, $row);
                }

                $expenditureTotalQuery = Yii::$app->db->createCommand("SELECT SUM(amount) FROM bt_expense WHERE id_type=1 and id_customer=" . $userId . " and (date_of_transaction BETWEEN '" . $startDate . "' AND '" . $endDate . "')");
                $expenditureTotal = $expenditureTotalQuery->queryScalar();



                $response['categoryImagePath'] = 'https://walletplus.in/category/';
                $response['expenseTotal'] = ($expenseTotal) ? $expenseTotal : 0;
                $response['expenditureTotal'] = ($expenditureTotal) ? $expenditureTotal : 0;
                $response['incomeTotal'] = ($incomeTotal) ? $incomeTotal : 0;
                $response['categories'] = $categories;
                $response['expenseData'] = $expenseData;

                return \yii\helpers\Json::encode($response);
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


    public function actionAdd()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();

            if ($user) {

                $data = Yii::$app->request->post();
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $id_type = 0;
                switch (Yii::$app->request->post('type')) {
                    case 'expense':
                        $id_type = 2;
                        break;
                    case 'savings':
                        $id_type = 1;
                        break;
                    case 'income':
                        $id_type = 3;
                        break;
                }

                if ($id_type == 0) {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Invalid Expense Type']);
                }

                $newExpense = new Expense();
                $newExpense->id_type = $id_type;
                $newExpense->id_customer = $user->id;
                $newExpense->id_category = Yii::$app->request->post('category');
                $newExpense->expense_name =  Yii::$app->request->post('name');
                $newExpense->description = Yii::$app->request->post('description');
                $newExpense->amount = Yii::$app->request->post('amount');

                $dateOfTransaction = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('dateOfTransaction'));
                if ($dateOfTransaction) {
                    $newExpense->date_of_transaction = $dateOfTransaction->format('d/m/Y');
                } else {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Invalid date format']);
                }

                // Handle the uploaded image
                $imageFile = UploadedFile::getInstanceByName('image');
                if ($imageFile) {
                    $uploadPath = Yii::getAlias('@webroot') . '/expenses/';
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
                        $newExpense->image = $compressedImageName;
                    } else if (in_array($imageFileExtension, $fileExtensions)) {
                        $newExpense->image = $imageName;
                    } else {
                        Yii::$app->response->statusCode = 500;
                        return \yii\helpers\Json::encode(['error' => 'Unsupported image type. Please upload a JPG, PNG, GIF, BMP, or WebP file.']);
                    }
                }

                $newExpense->id_event = Yii::$app->request->post('id_event');

                // Handle expense-member relationships
                $members = Yii::$app->request->post('members', []);
                if (!is_array($members)) {
                    $members = json_decode($members, true); // Ensure members is an array
                }

                // Remove existing members
                ExpenseMember::deleteAll(['id_expense' => $newExpense->id_expense]);

                // Add new members
                foreach ($members as $id_member) {
                    $expenseMember = new ExpenseMember();
                    $expenseMember->id_expense = $newExpense->id_expense;
                    $expenseMember->id_member = $id_member;
                    if (!$expenseMember->save()) {
                        Yii::error('Failed to add member ID: ' . $id_member);
                    }
                }

                if ($newExpense->save()) {
                    Yii::$app->response->statusCode = 201; // Created status code
                    return \yii\helpers\Json::encode($newExpense);
                } else {
                    Yii::$app->response->statusCode = 422; // Unprocessable Entity status code
                    return \yii\helpers\Json::encode($newExpense->getErrors());
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

    public function actionUpdate()
    {

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $id = Yii::$app->request->post('id');
                // $data = Yii::$app->request->post();

                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $id_type = 0;
                switch (Yii::$app->request->post('type')) {
                    case 'expense':
                        $id_type = 2;
                        break;
                    case 'savings':
                        $id_type = 1;
                        break;
                    case 'income':
                        $id_type = 3;
                        break;
                }
                if ($id_type == 0) {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Invalid Expense Type']);
                }

                $newExpense = Expense::findOne($id);
                $newExpense->id_type = $id_type;
                $newExpense->id_customer = $user->id;
                $newExpense->id_category = Yii::$app->request->post('category');
                $newExpense->expense_name =  Yii::$app->request->post('name');
                $newExpense->description = Yii::$app->request->post('description');
                $newExpense->amount = Yii::$app->request->post('amount');

                $dateOfTransaction = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('dateOfTransaction'));
                if ($dateOfTransaction) {
                    $newExpense->date_of_transaction = $dateOfTransaction->format('d/m/Y');
                } else {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Invalid date format']);
                }

                // Handle the uploaded image
                $imageFile = UploadedFile::getInstanceByName('image');
                if ($imageFile) {
                    $uploadPath = Yii::getAlias('@webroot') . '/expenses/';
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
                        $newExpense->image = $compressedImageName;
                    } else if (in_array($imageFileExtension, $fileExtensions)) {
                        $newExpense->image = $imageName;
                    } else {
                        Yii::$app->response->statusCode = 500;
                        return \yii\helpers\Json::encode(['error' => 'Unsupported image type. Please upload a JPG, PNG, GIF, BMP, or WebP file.']);
                    }
                }

                $newExpense->id_event = Yii::$app->request->post('id_event');
                
                 // Handle members list
            $members = Yii::$app->request->post('members');
            if (is_null($members)) {
                $members = []; // Default to empty array if null
            } else {
                $members = json_decode($members, true);
                if (!is_array($members)) {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Invalid members format']);
                }
            }

            // Get existing members for the expense
            $existingMembers = ExpenseMember::findAll(['id_expense' => $id]);
            $existingMemberIds = array_map(function($member) {
                return $member->id_member;
            }, $existingMembers);

            // Determine members to add and remove
            $membersToAdd = array_diff($members, $existingMemberIds);
            $membersToRemove = array_diff($existingMemberIds, $members);

            // Add new members
            foreach ($membersToAdd as $memberId) {
                $expenseMember = new ExpenseMember();
                $expenseMember->id_expense = $id;
                $expenseMember->id_member = $memberId;
                if (!$expenseMember->save()) {
                    Yii::error('Failed to add member ID: ' . $memberId);
                }
            }

            // Remove old members
            foreach ($membersToRemove as $memberId) {
                ExpenseMember::deleteAll(['id_expense' => $id, 'id_member' => $memberId]);
            }

                if ($newExpense->save()) {
                    Yii::$app->response->statusCode = 201; // Created status code
                    return \yii\helpers\Json::encode($newExpense);
                } else {
                    Yii::$app->response->statusCode = 422; // Unprocessable Entity status code
                    return \yii\helpers\Json::encode($newExpense->getErrors());
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


    public function actionDelete()
    {

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $expense = Expense::findOne($data['id']);

                if ($expense) {
                    // Delete the associated image file if it exists
                    if ($expense->image) {
                        $imagePath = Yii::getAlias('@webroot') . '/expenses/' . $expense->image;
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }

                    if ($expense->delete()) {
                        Yii::$app->response->statusCode = 204; // No Content status code
                        return \yii\helpers\Json::encode(['message' => 'Expense deleted successfully']);
                    } else {
                        Yii::$app->response->statusCode = 500; // Internal Server Error status code
                        return \yii\helpers\Json::encode(['error' => 'Failed to delete expense']);
                    }
                } else {
                    Yii::$app->response->statusCode = 404; // Not Found status code
                    return \yii\helpers\Json::encode(['error' => 'Expense not found']);
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

    public function actionEvents()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();

            if ($user) {
                $events = Events::find()
                    ->where(['id_customer' => $user->id])
                    ->orderBy(['id_event' => SORT_DESC])
                    ->all();

                $eventData = [];
                foreach ($events as $event) {
                    // Retrieve participants with names for each event
                    $participantsQuery = (new Query())
                    ->select(['bt_event_member.id_member', 'bt_member.firstname', 'bt_member.lastname']) // Correct table
                    ->from('bt_event_member')
                    ->leftJoin('bt_member', 'bt_event_member.id_member = bt_member.id_member')
                    ->where(['bt_event_member.id_event' => $event->id_event]);

                    $participantsCommand = $participantsQuery->createCommand();
                    $participants = $participantsCommand->queryAll(); // Get all participant details

                    // Format participants to include their names
                    $formattedParticipants = array_map(function ($participant) {
                        return [
                            'id_member' => $participant['id_member'],
                            'firstname' => $participant['firstname'],
                            'lastname' => $participant['lastname']
                        ];
                    }, $participants);

                    $eventData[] = [
                        'id_event' => $event->id_event,
                        'event_name' => $event->event_name,
                        'start_date' => $event->start_date,
                        'end_date' => $event->end_date,
                        'status' => $event->status,
                        'id_customer' => $event->id_customer,
                        'members' => $formattedParticipants
                    ];
                }

                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode($eventData);
            } else {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionEvent()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
    
            if ($user) {
                $data = Yii::$app->request->post();
                $eventId = Yii::$app->request->post('id'); // Event ID will determine add or update
                $newEvent = $eventId ? Events::findOne($eventId) : new Events();
    
                if (!$newEvent) {
                    Yii::$app->response->statusCode = 404;
                    return \yii\helpers\Json::encode(['error' => 'Event not found']);
                }
    
                // Assign event data
                $newEvent->id_customer = $user->id;
                $newEvent->event_name = Yii::$app->request->post('name');
                $newEvent->status = Yii::$app->request->post('status');
    
                $start_date = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('start_date'));
                if ($start_date) {
                    $newEvent->start_date = $start_date->format('Y-m-d');
                } else {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Invalid start date format']);
                }
    
                $end_date = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('end_date'));
                if ($end_date) {
                    $newEvent->end_date = $end_date->format('Y-m-d');
                } else {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Invalid end date format']);
                }
    
                // Save the event first before managing participants
                if ($newEvent->save()) {
                    // Handle participants logic
                    $participantsJson = Yii::$app->request->post('members', '[]');
                    $newParticipants = json_decode($participantsJson, true);
    
                    // Ensure $newParticipants is an array
                    if (!is_array($newParticipants)) {
                        $newParticipants = [];
                    }
    
                    // Get existing participants or initialize as an empty array
                    $existingParticipants = EventMember::find()
                        ->select('id_member')
                        ->where(['id_event' => $newEvent->id_event])
                        ->column();
                    $existingParticipants = $existingParticipants ?: [];
    
                    // Find participants to add and remove
                    if (is_array($existingParticipants) && is_array($newParticipants)) {
                        $participantsToRemove = array_diff($existingParticipants, $newParticipants);
                        $participantsToAdd = array_diff($newParticipants, $existingParticipants);
    
                        // Remove unassigned participants
                        if (!empty($participantsToRemove)) {
                            EventMember::deleteAll(['id_event' => $newEvent->id_event, 'id_member' => $participantsToRemove]);
                        }
    
                        // Add new participants
                        if (!empty($participantsToAdd)) {
                            foreach ($participantsToAdd as $participantId) {
                                $eventParticipant = new EventMember();
                                $eventParticipant->id_event = $newEvent->id_event;
                                $eventParticipant->id_member = $participantId;
                                if (!$eventParticipant->save()) {
                                    Yii::error('Failed to add participant ID: ' . $participantId);
                                }
                            }
                        }
                    }
    
                    // Return the newly saved event data
                    Yii::$app->response->statusCode = $eventId ? 200 : 201;
                    return \yii\helpers\Json::encode($newEvent);
                } else {
                    Yii::$app->response->statusCode = 422;
                    return \yii\helpers\Json::encode($newEvent->getErrors());
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
    
    

    // public function actionAddEvent()
    // {   
    //     $headers = Yii::$app->request->headers;
    //     if ($headers->has('Authorization')) {
    //         $authorizationHeader = $headers->get('Authorization');
    //         $token = str_replace('Bearer ', '', $authorizationHeader);
    //         $user = Customer::find()->where(['authKey' => $token])->one();

    //         if($user){

    //             $data = Yii::$app->request->post();
    //             $rawBody = Yii::$app->request->rawBody;
    //             $data = json_decode($rawBody, true);


    //             $newEvent = new Events();
    //             // $newExpense->id_type = $id_event;
    //             $newEvent->id_customer = $user->id;
    //             // $newExpense->id_category = Yii::$app->request->post('category'); 
    //             // $newEvent->description = Yii::$app->request->post('description'); 
    //             $newEvent->event_name =  Yii::$app->request->post('name'); 
    //             $newEvent->status = Yii::$app->request->post('status'); 

    //             $start_date = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('start_date'));
    //             if ($start_date) {
    //                 $newEvent->start_date = $start_date->format('Y-m-d');
    //             } else {
    //                 Yii::$app->response->statusCode = 400;
    //                 return \yii\helpers\Json::encode(['error' => 'Invalid date format']);
    //             }

    //             $end_date = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('end_date'));
    //             if ($end_date) {
    //                 $newEvent->end_date = $end_date->format('Y-m-d');
    //             } else {
    //                 Yii::$app->response->statusCode = 400;
    //                 return \yii\helpers\Json::encode(['error' => 'Invalid date format']);
    //             }

    //             // Handle the uploaded image
    //             // $imageFile = UploadedFile::getInstanceByName('image');
    //             // if ($imageFile) {
    //             //     $uploadPath = Yii::getAlias('@webroot') . '/expenses/';
    //             //     $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
    //             //     $imageFile->saveAs($uploadPath . $imageName);


    //             //     $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
    //             //     $fileExtensions = ['pdf'];
    //             //     $imageFileExtension = strtolower($imageFile->extension);

    //             //     if (in_array($imageFileExtension, $imageExtensions)) {

    //             //         $image = Image::make($uploadPath . $imageName);
    //             //         $image->encode('jpg', 70); 
    //             //         $compressedImageName = 'wplus_' . $imageName;
    //             //         $image->save($uploadPath . $compressedImageName);
    //             //         $newExpense->image = $compressedImageName;

    //             //     } else if (in_array($imageFileExtension, $fileExtensions)) {
    //             //         $newExpense->image = $imageName;
    //             //     } else {
    //             //         Yii::$app->response->statusCode = 500;
    //             //         return \yii\helpers\Json::encode(['error' => 'Unsupported image type. Please upload a JPG, PNG, GIF, BMP, or WebP file.']);
    //             //     }

    //             // }

    //             if ($newEvent->save()) {

    //                 if (!empty($participants)) {
    //                     foreach ($participants as $participantId) {
    //                         $eventParticipant = new EventParticipants();
    //                         $eventParticipant->id_event = $newEvent->id; // Assuming $newEvent is the event object
    //                         $eventParticipant->id_customer = $participantId; // Assuming participant ID is the user ID
    //                         if (!$eventParticipant->save()) {
    //                             // Handle error if saving fails
    //                             Yii::error('Failed to add participant ID: ' . $participantId);
    //                         }
    //                     }
    //                 }

    //                 Yii::$app->response->statusCode = 201; // Created status code
    //                 return \yii\helpers\Json::encode($newEvent);
    //             } else {
    //                 Yii::$app->response->statusCode = 422; // Unprocessable Entity status code
    //                 return \yii\helpers\Json::encode($newEvent->getErrors());
    //             }
    //         } else {
    //             Yii::$app->response->statusCode = 401;
    //             return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
    //         }
    //     } else {
    //         Yii::$app->response->statusCode = 401;
    //         return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
    //     }

    // }

    // public function actionUpdateEvent()
    // {   

    //     $headers = Yii::$app->request->headers;
    //     if ($headers->has('Authorization')) {
    //         $authorizationHeader = $headers->get('Authorization');
    //         $token = str_replace('Bearer ', '', $authorizationHeader);
    //         $user = Customer::find()->where(['authKey' => $token])->one();
    //         if($user){
    //             $id = Yii::$app->request->post('id');
    //             // $data = Yii::$app->request->post();


    //             $newEvent = Events::findOne($id);
    //             $newEvent->id_customer = $user->id;
    //             $newEvent->event_name =  Yii::$app->request->post('name'); 
    //             $newEvent->status = Yii::$app->request->post('status'); 

    //             $start_date = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('start_date'));
    //             if ($start_date) {
    //                 $newEvent->start_date = $start_date->format('Y-m-d');
    //             } else {
    //                 Yii::$app->response->statusCode = 400;
    //                 return \yii\helpers\Json::encode(['error' => 'Invalid date format']);
    //             }

    //             $end_date = DateTime::createFromFormat('Y-m-d', Yii::$app->request->post('end_date'));
    //             if ($end_date) {
    //                 $newEvent->end_date = $end_date->format('Y-m-d');
    //             } else {
    //                 Yii::$app->response->statusCode = 400;
    //                 return \yii\helpers\Json::encode(['error' => 'Invalid date format']);
    //             }

    //             $participantsJson = Yii::$app->request->post('members', '[]');  // Default to empty JSON array if not set
    //             $newParticipants = json_decode($participantsJson, true);  

    //             $existingParticipants = EventParticipants::find()
    //                 ->select('id_customer')
    //                 ->where(['id_event' => $id])
    //                 ->column(); 

    //             // Find participants to remove (present in the existing but not in the new list)
    //             $participantsToRemove = array_diff($existingParticipants, $newParticipants);

    //             // Find participants to add (present in the new list but not in the existing list)
    //             $participantsToAdd = array_diff($newParticipants, $existingParticipants);

    //             // Remove participants no longer assigned to the event
    //             if (!empty($participantsToRemove)) {
    //                 EventParticipants::deleteAll([
    //                     'id_event' => $id,
    //                     'id_customer' => $participantsToRemove,
    //                 ]);
    //             }

    //             // Add new participants to the event
    //             if (!empty($participantsToAdd)) {
    //                 foreach ($participantsToAdd as $participantId) {
    //                     $eventParticipant = new EventParticipants();
    //                     $eventParticipant->id_event = $id;
    //                     $eventParticipant->id_customer = $participantId;
    //                     if (!$eventParticipant->save()) {
    //                         Yii::error('Failed to add participant ID: ' . $participantId);
    //                     }
    //                 }
    //             }

    //             // // Handle the uploaded image
    //             // $imageFile = UploadedFile::getInstanceByName('image');
    //             // if ($imageFile) {
    //             //     $uploadPath = Yii::getAlias('@webroot') . '/expenses/';
    //             //     $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
    //             //     $imageFile->saveAs($uploadPath . $imageName);

    //             //     $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
    //             //     $fileExtensions = ['pdf'];
    //             //     $imageFileExtension = strtolower($imageFile->extension);

    //             //     if (in_array($imageFileExtension, $imageExtensions)) {

    //             //         $image = Image::make($uploadPath . $imageName);
    //             //         $image->encode('jpg', 70); 
    //             //         $compressedImageName = 'wplus_' . $imageName;
    //             //         $image->save($uploadPath . $compressedImageName);
    //             //         $newExpense->image = $compressedImageName;

    //             //     } else if (in_array($imageFileExtension, $fileExtensions)) {
    //             //         $newExpense->image = $imageName;
    //             //     } else {
    //             //         Yii::$app->response->statusCode = 500;
    //             //         return \yii\helpers\Json::encode(['error' => 'Unsupported image type. Please upload a JPG, PNG, GIF, BMP, or WebP file.']);
    //             //     }
    //             // }

    //             if ($newEvent->save()) {
    //                 Yii::$app->response->statusCode = 201; // Created status code
    //                 return \yii\helpers\Json::encode($newEvent);
    //             } else {
    //                 Yii::$app->response->statusCode = 422; // Unprocessable Entity status code
    //                 return \yii\helpers\Json::encode($newEvent->getErrors());
    //             }
    //         } else {
    //             Yii::$app->response->statusCode = 401;
    //             return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
    //         }
    //     } else {
    //         Yii::$app->response->statusCode = 401;
    //         return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
    //     }
    // }

    public function actionDeleteEvent()
    {

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $event = Events::findOne($data['id']);

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

    public function actionEventDetails()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                $id = Yii::$app->request->post('id');
                $query = (new Query())
                    ->select('*')
                    ->from('bt_events')
                    // ->where(['bt_events.id_customer' => $user->id])
                    ->where(['bt_events.id_event' => $id]);

                $command = $query->createCommand();
                $eventData = $command->queryOne();


                $participantsQuery = (new Query())
                    ->select('id_member')
                    ->from('bt_event_member')
                    ->where(['id_event' => $id]);

                $participantsCommand = $participantsQuery->createCommand();
                $participants = $participantsCommand->queryColumn(); // Retrieves an array of participant IDs

                $participants = array_map('intval', $participants);

                $response = [
                    'data' => $eventData,
                    'members' => $participants,
                ];
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
                $id_type = 2;

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
                }

                $categories = ExpenseCategory::find()
                    ->where(['id_type' => $id_type])
                    ->orderBy(['category_name' => SORT_ASC])
                    ->all();
                $response['list'] = $categories;
                $response['categoryImagePath'] = 'https://walletplus.in/category/';
                $response['imagePath'] = 'https://walletplus.in/expenses/';

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

    public function actionCategoryDetails()
    {
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
                $response['imagePath'] = 'http://localhost/walletplus/category/';
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

    public function actionDeleteCategory()
    {

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



    public function actionCategory()
    {
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
                // $category->category_image = Yii::$app->request->post('category_image', null); // Optional
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


    public function actionMembersList()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {

                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);

                $query = (new Query())
                    ->select('*')
                    ->from('bt_member')
                    ->where(['id_customer' => $user->id]);

                $command = $query->createCommand();
                $list = $command->queryAll();
                $response['list'] = $list;
                $response['categoryImagePath'] = 'https://walletplus.in/category/';
                $response['imagePath'] = 'https://walletplus.in/expenses/';
                $response['expenseImagePath'] = 'https://walletplus.in/expenses/';
                $response['userImagePath'] = 'https://walletplus.in/users/';


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

    public function actionMember()
    {
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();

            if ($user) {
                $data = Yii::$app->request->post();
                $memberId = Yii::$app->request->post('id_member'); // ID to determine add or update
                $member = $memberId ? Member::findOne($memberId) : new Member();

                if (!$member) {
                    Yii::$app->response->statusCode = 404;
                    return \yii\helpers\Json::encode(['error' => 'Member not found']);
                }

                // Assign data to member model
                $member->firstname = Yii::$app->request->post('firstname');
                $member->lastname = Yii::$app->request->post('lastname');
                $member->phone_number = Yii::$app->request->post('phone_number');
                $member->id_customer = $user->id;

                $member->date_updated = date('Y-m-d H:i:s'); // Update timestamp

                // If creating a new member, set the creation date
                if (!$memberId) {
                    $member->date_created = date('Y-m-d H:i:s');
                }

                // Save member data
                if ($member->save()) {
                    Yii::$app->response->statusCode = $memberId ? 200 : 201;
                    return \yii\helpers\Json::encode($member);
                } else {
                    Yii::$app->response->statusCode = 422;
                    return \yii\helpers\Json::encode($member->getErrors());
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

    public function actionMemberDetails()
    {
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
                    ->from('bt_member')
                    ->where(['bt_member.id_member' => $id]);

                $command = $query->createCommand();
                $data = $command->queryOne();
                $response['data'] = $data;
                $response['imagePath'] = 'http://localhost/walletplus/category/';
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

    public function actionExpenseMemberTotal()
    {
        $headers = Yii::$app->request->headers;
    
        // Check if the Authorization header is present
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
    
            // Find the user based on the provided auth key
            $user = Customer::find()->where(['authKey' => $token])->one();
    
            // Check if the user is authenticated
            if ($user) {
                $eventId = Yii::$app->request->post('id');
                
                if (!$eventId) {
                    Yii::$app->response->statusCode = 400;
                    return \yii\helpers\Json::encode(['error' => 'Event ID is required']);
                }
    
                // Fetch all expenses for the given event
                $expensesQuery = (new Query())
                    ->select('e.id_expense, e.amount')
                    ->from('bt_expense e')
                    ->where(['e.id_event' => $eventId]);
    
                $expensesCommand = $expensesQuery->createCommand();
                $expenses = $expensesCommand->queryAll();
    
                // Initialize array to keep track of member expenses
                $memberTotals = [];
                $eventTotal = 0;
    
                foreach ($expenses as $expense) {
                    // Accumulate total event expenses
                    $eventTotal += $expense['amount'];
    
                    // Fetch members for each expense
                    $membersQuery = (new Query())
                        ->select('em.id_member')
                        ->from('bt_expense_member em')
                        ->where(['em.id_expense' => $expense['id_expense']]);
    
                    $membersCommand = $membersQuery->createCommand();
                    $members = $membersCommand->queryColumn(); // Get members as an array
    
                    // Calculate individual share
                    $numMembers = count($members);
                    $share = $numMembers > 0 ? $expense['amount'] / $numMembers : 0;
    
                    // Add the share to each member's total
                    foreach ($members as $memberId) {
                        if (!isset($memberTotals[$memberId])) {
                            $memberTotals[$memberId] = 0;
                        }
                        $memberTotals[$memberId] += $share;
                    }
                }
    
                // Fetch member details
                $membersQuery = (new Query())
                    ->select('m.id_member, m.firstname, m.lastname')
                    ->from('bt_member m')
                    ->where(['m.id_member' => array_keys($memberTotals)]);
    
                $membersCommand = $membersQuery->createCommand();
                $members = $membersCommand->queryAll();
    
                // Prepare the response
                $response = [
                    'event_total' => $eventTotal, // Add the event total to the response
                    'data' => []
                ];
    
                foreach ($members as $member) {
                    $response['data'][] = [
                        'id_member' => $member['id_member'],
                        'firstname' => $member['firstname'],
                        'lastname' => $member['lastname'],
                        'total_amount' => isset($memberTotals[$member['id_member']]) ? $memberTotals[$member['id_member']] : 0
                    ];
                }
    
                $response['imagePath'] = 'http://localhost/walletplus/expenses/';
    
                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode($response);
            } else {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Authorization header is missing']);
        }
    }
    
    
    
    

    public function beforeAction($action)
    {
        if (in_array($action->id, ['expense-member-total','member-details', 'member', 'members-list', 'category', 'category-details', 'events', 'event', 'event-details', 'send-report', 'statistics', 'category-list', 'get', 'update', 'delete', 'delete-event', 'get-list', 'add', 'suggestion'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}
