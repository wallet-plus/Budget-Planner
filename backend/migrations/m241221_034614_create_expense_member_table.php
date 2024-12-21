<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expense_member}}`.
 */
class m241221_034614_create_expense_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%expense_member}}', [
            'id_expense_member' => $this->primaryKey(), // Set as primary key
            'id_expense' => $this->integer(11)->notNull(),
            'id_member' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%expense_member}}');
    }
}
