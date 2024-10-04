<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_category".
 *
 * @property int $id_category
 * @property int $parent
 * @property string|null $category_name
 * @property int $status
 */
class ExpenseCategory extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'id_type', 'status'], 'required'],
            [['parent', 'status','id_type','id_user'], 'integer'],
            [['category_name', 'category_image'], 'string', 'max' => 255],
            [['category_name'], 'unique'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, pdf'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_category' => Yii::t('app', 'Id Categories'),
            'id_type' => Yii::t('app', 'Type'),
            'id_user' => Yii::t('app', 'User'),
            'parent' => Yii::t('app', 'Parent'),
            'category_name' => Yii::t('app', 'Category Name'),
            'category_image' => Yii::t('app', 'Category Image'),
            'status' => Yii::t('app', 'Status'),

        ];
    }
}
