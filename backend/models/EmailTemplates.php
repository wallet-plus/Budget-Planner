<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_email_templates".
 *
 * @property int $id_email_template
 * @property string|null $title
 * @property string|null $email_template
 * @property int|null $create_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string $updated_at
 */
class EmailTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_email_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_by', 'updated_by'], 'integer'],
            [['email_template'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_email_template' => 'Id Email Template',
            'title' => 'Title',
            'email_template' => 'Email Template',
            'create_by' => 'Create By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
