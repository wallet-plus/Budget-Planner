<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_event_member".
 *
 * @property int $id_participant
 * @property int $id_member
 * @property int|null $id_event
 * @property int|null $id_customer
 */
class EventMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_event_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_member'], 'required'],
            [['id_member', 'id_event', 'id_customer'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_participant' => 'Id Participant',
            'id_member' => 'Id Member',
            'id_event' => 'Id Event',
            'id_customer' => 'Id Customer',
        ];
    }
}
