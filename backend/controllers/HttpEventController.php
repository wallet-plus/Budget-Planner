<?php

namespace app\controllers;

use Yii;
use app\models\Member;
use DateTime;
use yii\db\Query;
use app\models\Customer;
use app\models\Events;
use app\models\EventMember;

class HttpEventController extends \yii\web\Controller
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

    public function actionEvents()
    {

        $user = $this->getAuthorizedUser();
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
    }

    public function actionEvent()
    {
        $user = $this->getAuthorizedUser();
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
    }

    public function actionDeleteEvent()
    {

        $user = $this->getAuthorizedUser();
        if ($user) {
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
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionEventDetails()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {
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
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionMembersList()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {
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
                        ->where(['id_customer' => $user->id])
                        ->orderBy(['id_member' => SORT_DESC]);

                    $command = $query->createCommand();
                    $list = $command->queryAll();
                    $response['list'] = $list;
                    $response['categoryImagePath'] = Yii::$app->params['categoryImagePath'];
                    $response['imagePath'] = Yii::$app->params['expenseImagePath'];
                    $response['expenseImagePath'] = Yii::$app->params['expenseImagePath'];
                    $response['userImagePath'] = Yii::$app->params['userImagePath'];


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
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionMember()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {
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
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionMemberDetails()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {
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
                    $response['imagePath'] = Yii::$app->params['expenseImagePath'];
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
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }

    public function actionDeleteMember()
    {
        $user = $this->getAuthorizedUser();
        if ($user) {

            $headers = Yii::$app->request->headers;
            if ($headers->has('Authorization')) {
                $authorizationHeader = $headers->get('Authorization');
                $token = str_replace('Bearer ', '', $authorizationHeader);
                $user = Customer::find()->where(['authKey' => $token])->one();
                if ($user) {
                    $rawBody = Yii::$app->request->rawBody;
                    $data = json_decode($rawBody, true);

                    $event = Member::findOne($data['id']);
                    if ($event) {

                        if ($event->delete()) {
                            Yii::$app->response->statusCode = 204; // No Content status code
                            return \yii\helpers\Json::encode(['message' => 'Member deleted successfully']);
                        } else {
                            Yii::$app->response->statusCode = 500; // Internal Server Error status code
                            return \yii\helpers\Json::encode(['error' => 'Failed to delete Member']);
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
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }


    public function actionExpenseMemberTotal()
    {

        $user = $this->getAuthorizedUser();
        if ($user) {
            $eventId = Yii::$app->request->post('id');

            // Fetch total expense per expense and divide by the number of members involved
            $query = (new Query())
                ->select([
                    'em.id_member',
                    'm.firstname',
                    'm.lastname',
                    'e.amount AS expense_amount', // Get the amount for each expense
                    '(SELECT COUNT(*) FROM bt_expense_member WHERE id_expense = e.id_expense) AS member_count' // Count of members involved in the expense
                ])
                ->from('bt_expense e')
                ->innerJoin('bt_expense_member em', 'e.id_expense = em.id_expense')
                ->innerJoin('bt_member m', 'em.id_member = m.id_member') // Join with member table
                ->where(['e.id_event' => $eventId]);

            $command = $query->createCommand();
            $results = $command->queryAll();

            // Check if results were found
            if ($results) {
                $memberShares = [];
                $totalExpenseAmount = 0; // Initialize total expense amount

                // Iterate over each result (each expense and member)
                foreach ($results as $result) {
                    // Calculate the individual share for this member in the current expense
                    $shareAmount = $result['expense_amount'] / $result['member_count'];

                    // Accumulate the total amount for each member
                    if (!isset($memberShares[$result['id_member']])) {
                        $memberShares[$result['id_member']] = [
                            'id_member' => $result['id_member'],
                            'firstname' => $result['firstname'],
                            'lastname' => $result['lastname'],
                            'total_amount' => 0, // Initialize total amount
                        ];
                    }

                    // Add the share amount for the current expense
                    $memberShares[$result['id_member']]['total_amount'] += $shareAmount;

                    // Add to the total expense amount
                    $totalExpenseAmount += $result['expense_amount'];
                }

                // Calculate the event total based on individual member totals
                $eventTotal = array_sum(array_column($memberShares, 'total_amount'));

                // Prepare the response
                $response = [
                    'data' => array_values($memberShares), // Re-index the array for response
                    'event_total' => $eventTotal,           // Total amount from individual members' totals
                    'imagePath' => Yii::$app->params['expenseImagePath'],
                ];
                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode($response);
            } else {
                Yii::$app->response->statusCode = 404;
                return \yii\helpers\Json::encode(['error' => 'No expenses found for the specified event']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'Unauthorized']);
        }
    }






    public function beforeAction($action)
    {
        if (in_array($action->id, [
            'expense-member-total',
            'events',
            'event',
            'event-details',
            'delete-event',
            'member-details',
            'member',
            'members-list',
            'delete-member'
        ])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}
