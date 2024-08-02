<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_email".
 *
 * @property int $id_email
 * @property string|null $name
 * @property int|null $id_email_template
 * @property string $email_content
 * @property string|null $from_name
 * @property string|null $from_email
 * @property string|null $subject
 * @property string|null $cc_email
 * @property int|null $create_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string $updated_at
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_email';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_email_template', 'create_by', 'updated_by'], 'integer'],
            [['email_content'], 'required'],
            [['email_content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'from_name', 'from_email', 'subject', 'cc_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_email' => 'Id Email',
            'name' => 'Name',
            'id_email_template' => 'Id Email Template',
            'email_content' => 'Email Content',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'subject' => 'Subject',
            'cc_email' => 'Cc Email',
            'create_by' => 'Create By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
