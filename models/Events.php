<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_events".
 *
 * @property int $id_event
 * @property string $event_name
 * @property string $start_date
 * @property string $end_date
 * @property int|null $status
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_name'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['status','id_customer'], 'integer'],
            [['event_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_event' => 'Id Event',
            'id_customer' => 'Customer Id',
            'event_name' => 'Event Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
        ];
    }
}
