<?php
use yii\db\Migration;

/**
 * Class mYYYYMMDD_HHMMSS_create_bt_event_member_table
 */
class m241221_033426_create_bt_event_member_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%event_member}}', [
            'id_participant' => $this->primaryKey(),  // Automatically set as primary key
            'id_member' => $this->integer()->notNull(),  // Member ID (required)
            'id_event' => $this->integer()->null(),  // Event ID (can be NULL)
            'id_customer' => $this->integer()->null(),  // Customer ID (can be NULL)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%event_member}}');  // Drop the table in case of rollback
    }
}
