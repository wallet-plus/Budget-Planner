<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bt_cards}}`.
 */
class m241220_094826_create_bt_cards_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bt_cards}}', [
            'id_card' => $this->primaryKey(),
            'id_cards_type' => $this->integer()->defaultValue(null),
            'id_customer' => $this->integer()->defaultValue(null),
            'name' => $this->string(255)->defaultValue(null),
            'image' => $this->string(255)->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-bt_cards-id_cards_type', 'bt_cards');
        $this->dropTable('bt_cards');
    }
}
