<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%member}}`.
 */
class m241221_034741_create_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%member}}', [
            'id_member' => $this->primaryKey(), // Set as primary key
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->defaultValue(null),
            'phone_number' => $this->string(15)->defaultValue(null),
            'id_customer' => $this->integer(11)->notNull(),
            'date_created' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%member}}');
    }
}
