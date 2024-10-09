<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_customer_type".
 *
 * @property int $id_customer_type
 * @property string|null $name
 * @property int|null $status
 */
class CustomerType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_customer_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_customer_type' => 'Id Customer Type',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }
}
