<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_type".
 *
 * @property int $id_type
 * @property string $name
 * @property int $status
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status', 'parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_type' => 'Id Category',
            'name' => 'Category Name',
            'status' => 'Status',
            'parent' => 'Parent'
        ];
    }

    public function getCategories(){

        return Category::find()
        ->where(['and', "status=1"])
        ->all();
    }

    public function beforeSave($insert) {
        // if ($this->isNewRecord) {
        //     $this->deleted = 0;
        //     $this->created_by = 1;
        //     // $this->date_created = new CDbExpression('NOW()');
        //     $this->date_created = new \yii\db\Expression('NOW()');
        // } else {
        //     // $this->date_updated = new CDbExpression('NOW()');
        //     // $this->date_updated = date('Y-m-d', $this->date);
        //     $this->updated_by = 1;
        //     $this->date_updated = new \yii\db\Expression('NOW()');
        // }
        return parent::beforeSave($insert);
    }


}
