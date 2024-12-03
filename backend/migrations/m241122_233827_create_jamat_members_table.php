<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jamat_members}}`.
 */
class m241122_233827_create_jamat_members_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%jamat_members}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jamat_members}}');
    }
}
