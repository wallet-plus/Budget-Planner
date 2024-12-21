<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bt_events}}`.
 */
class m241221_033308_create_bt_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id_event' => $this->primaryKey(),  // Automatically sets id_event as the primary key
            'id_customer' => $this->integer()->null(),  // Customer ID (can be NULL)
            'event_name' => $this->string(255)->notNull(),  // Event name (mandatory field)
            'start_date' => $this->date()->notNull(),  // Start date (mandatory field)
            'end_date' => $this->date()->notNull(),  // End date (mandatory field)
            'status' => $this->tinyInteger(1)->defaultValue(1)->check('status in (0, 1)'),  // Status field with default value and check constraint
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
