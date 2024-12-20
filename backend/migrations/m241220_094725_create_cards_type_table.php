<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cards_type}}`.
 */
class m241220_094725_create_cards_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cards_type}}', [
            'id_cards_type' => $this->primaryKey(),
            'name' => $this->string(255)->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cards_type}}');
    }
}
