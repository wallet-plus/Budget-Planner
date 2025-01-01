<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_budget_planner".
 *
 * @property int $id_planner
 * @property int $user_id
 * @property int $category_id
 * @property float $amount
 * @property string $created_at
 * @property string $updated_at
 */
class BudgetPlanner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_budget_planner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'amount'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_planner' => 'Id Planner',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
