<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_reminders".
 *
 * @property int $id_reminder
 * @property string|null $name
 * @property string|null $description
 * @property string|null $date
 * @property int|null $created_by
 * @property string|null $date_created
 * @property int|null $updated_by
 * @property string|null $date_updated
 */
class Reminders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_reminders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'date_created', 'date_updated'], 'safe'],
            [['amount','id_customer', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_reminder' => Yii::t('app', 'Id Reminder'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'date_created' => Yii::t('app', 'Date Created'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'date_updated' => Yii::t('app', 'Date Updated'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RemindersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RemindersQuery(get_called_class());
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            // $this->deleted = 0;
            $this->id_customer = Yii::$app->user->id;
            $this->created_by = Yii::$app->user->id;
            // $this->date_created = new CDbExpression('NOW()');
            $this->date_created = new \yii\db\Expression('NOW()');
        } else {
            // $this->date_updated = new CDbExpression('NOW()');
            // $this->date_updated = date('Y-m-d', $this->date);
            $this->updated_by = Yii::$app->user->id;
            $this->date_updated = new \yii\db\Expression('NOW()');
        }
        return parent::beforeSave($insert);
    }
}
