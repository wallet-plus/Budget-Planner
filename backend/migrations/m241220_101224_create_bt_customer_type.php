<?php

use yii\db\Migration;

/**
 * Class m241220_101224_create_bt_customer_type
 */
class m241220_101224_create_bt_customer_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create table
        $this->createTable('{{%bt_customer_type}}', [
            'id_customer_type' => $this->primaryKey(),
            'name' => $this->string(255)->defaultValue(null),
            'status' => $this->integer()->defaultValue(null),
        ]);

        // Insert default data
        $this->batchInsert('{{%bt_customer_type}}', ['id_customer_type', 'name', 'status'], [
            [1, 'Super Admin', 1],
            [2, 'Admin', 1],
            [3, 'User', 1],
            [4, 'Corporate', 1],
            [5, 'Employee', 1],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bt_customer_type}}');
    }

}
