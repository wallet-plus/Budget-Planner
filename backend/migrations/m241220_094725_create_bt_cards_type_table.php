<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bt_cards_type}}`.
 */
class m241220_094725_create_bt_cards_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bt_cards_type}}', [
            'id_cards_type' => $this->primaryKey(),
            'name' => $this->string(255)->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bt_cards_type}}');
    }
}
