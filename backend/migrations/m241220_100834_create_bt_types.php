<?php

use yii\db\Migration;

/**
 * Class m241220_100834_create_bt_types
 */
class m241220_100834_create_bt_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create table
        $this->createTable('{{%bt_type}}', [
            'id_type' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'status' => $this->tinyInteger(1)->notNull(),
        ]);

        // Insert data
        $this->batchInsert('{{%bt_type}}', ['id_type', 'name', 'status'], [
            [1, 'savings', 1],
            [2, 'expenses', 1],
            [3, 'income', 1],
            [4, 'todo', 1],
            [5, 'wealth', 1],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bt_type}}');
    }

}
