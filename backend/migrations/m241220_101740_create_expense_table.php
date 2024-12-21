<?php

use yii\db\Migration;

/**
 * Class m241220_101740_create_expense
 */
class m241220_101740_create_expense_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create expense table
        $this->createTable('{{%expense}}', [
            'id_expense' => $this->primaryKey(), // Automatically set as primary key
            'id_type' => $this->integer(11)->defaultValue(null),
            'id_category' => $this->integer(11)->notNull(),
            'id_customer' => $this->integer(11)->defaultValue(null),
            'expense_name' => $this->string(255)->notNull(),
            'description' => $this->text()->defaultValue(null),
            'image' => $this->string(255)->defaultValue(null),
            'amount' => $this->string(255)->notNull(),
            'date_of_transaction' => $this->date()->defaultValue(null),
            'id_event' => $this->integer(11)->defaultValue(null), // Added field
            'deleted' => $this->integer(1)->defaultValue(null),
            'created_by' => $this->integer(11)->defaultValue(null),
            'date_created' => $this->dateTime()->defaultValue(null),
            'updated_by' => $this->integer(11)->defaultValue(null),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%expense}}');
    }
}
