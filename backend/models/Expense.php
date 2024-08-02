<?php

namespace app\models;

use Yii;
use app\models\CDbExpression;
/**
 * This is the model class for table "bt_expense".
 *
 * @property int $id_expense
 * @property int|null $id_type
 * @property int|null $id_customer
 * @property string $expense_name
 * @property string|null $description
 * @property string|null $image
 * @property string $amount
 * @property string $date_of_transaction
 * @property int|null $deleted
 * @property int|null $created_by
 * @property string|null $date_created
 * @property int|null $updated_by
 * @property string $date_updated
 */
class Expense extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_expense';
    }

    public function init()
    {
        parent::init();
        $this->date_of_transaction = date('d/m/Y'); // Set today's date as the default value
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_type', 'id_category', 'id_customer', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['expense_name', 'id_category', 'amount', 'date_of_transaction'], 'required'],
            [['description'], 'string'],
            [['date_of_transaction', 'date_created', 'date_updated'], 'safe'],
            [['expense_name','image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, pdf'],
            // [['date_of_transaction'], 'date', 'format' => 'yyyy-MM-dd'],
            ['amount', 'number', 'min' => 0, 'max' => 9999999.99]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_expense' => Yii::t('app', 'Id Expense'),
            'id_type' => Yii::t('app', 'Id Category'),
            'id_category' => Yii::t('app', 'Categories'),
            'id_customer' => Yii::t('app', 'Id Customer'),
            'expense_name' => Yii::t('app', 'Expense Name'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'amount' => Yii::t('app', 'Amount'),
            'date_of_transaction' => Yii::t('app', 'Date Of Transaction'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'date_created' => Yii::t('app', 'Date Created'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'date_updated' => Yii::t('app', 'Date Updated'),
            'imageFile'=> Yii::t('app', 'imageFile'),
        ];
    }

    public function beforeSave($insert) {


        // if (parent::beforeSave($insert)) {
            $this->date_of_transaction = \Yii::$app->formatter->asDate(\DateTime::createFromFormat('d/m/Y', $this->date_of_transaction), 'php:Y-m-d');
            // return true;
        // }

        // if (parent::beforeSave($insert)) {
        //     $this->date_of_transaction = \Yii::$app->formatter->asDate($this->date_of_transaction, 'php:Y-m-d');
        // }

        if ($this->isNewRecord) {
            $this->deleted = 0;
            // $this->id_customer = Yii::$app->user->id;
            // $this->created_by = Yii::$app->user->id;
            // $this->date_created = new CDbExpression('NOW()');
            $this->date_created = new \yii\db\Expression('NOW()');
        } else {
            // $this->date_updated = new CDbExpression('NOW()');
            // $this->date_updated = date('Y-m-d', $this->date);
            // $this->updated_by = Yii::$app->user->id;
            $this->date_updated = new \yii\db\Expression('NOW()');
        }
        return parent::beforeSave($insert);
    }


    // We can use after Fine Methods of in List 
    public function afterFind()
    {
        parent::afterFind();
        $this->date_of_transaction = \Yii::$app->formatter->asDate($this->date_of_transaction, 'php:d/m/Y');
    }

    // // in List we can do attribute level changes
    // [
    //     'attribute' => 'my_date',
    //     'format' => 'raw',
    //     'value' => function($model) {
    //         return \Yii::$app->formatter->asDate($model->date_of_transaction, 'php:d/m/Y');
    //     },
    // ],
}
