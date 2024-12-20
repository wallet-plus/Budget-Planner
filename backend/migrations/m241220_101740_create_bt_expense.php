<?php

use yii\db\Migration;

/**
 * Class m241220_101740_create_bt_expense
 */
class m241220_101740_create_bt_expense extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create bt_expense table
        $this->createTable('bt_expense', [
            'id_expense' => $this->integer(11)->notNull(),
            'id_type' => $this->integer(11)->defaultValue(null),
            'id_category' => $this->integer(11)->notNull(),
            'id_customer' => $this->integer(11)->defaultValue(null),
            'expense_name' => $this->string(255)->notNull(),
            'description' => $this->text()->defaultValue(null),
            'image' => $this->string(255)->defaultValue(null),
            'amount' => $this->string(255)->notNull(),
            'date_of_transaction' => $this->date()->defaultValue(null),
            'deleted' => $this->integer(1)->defaultValue(null),
            'created_by' => $this->integer(11)->defaultValue(null),
            'date_created' => $this->dateTime()->defaultValue(null),
            'updated_by' => $this->integer(11)->defaultValue(null),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('bt_expense');

    }

}
