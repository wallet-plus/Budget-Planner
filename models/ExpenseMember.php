<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_expense_member".
 *
 * @property int $id_expense_member
 * @property int $id_expense
 * @property int $id_member
 *
 * @property Expense $expense
 * @property Member $member
 */
class ExpenseMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_expense_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_expense', 'id_member'], 'required'],
            [['id_expense', 'id_member'], 'integer'],
            [['id_expense'], 'exist', 'skipOnError' => true, 'targetClass' => Expense::className(), 'targetAttribute' => ['id_expense' => 'id_expense']],
            [['id_member'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['id_member' => 'id_member']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_expense_member' => 'Id Expense Member',
            'id_expense' => 'Id Expense',
            'id_member' => 'Id Member',
        ];
    }

    /**
     * Gets query for [[Expense]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpense()
    {
        return $this->hasOne(Expense::className(), ['id_expense' => 'id_expense']);
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id_member' => 'id_member']);
    }
}
