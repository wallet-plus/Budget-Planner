<?php

use yii\db\Migration;

/**
 * Class m241220_101756_create_language_tables
 */
class m241220_101756_create_language_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create language table
        $this->createTable('{{%language}}', [
            'id_language' => $this->integer(11)->notNull(),
            'name' => $this->string(200)->defaultValue(null),
            'code' => $this->string(2)->notNull(),
            'status' => $this->integer(1)->defaultValue(null)->comment('1:Enable;0:Disable'),
        ]);

        // Insert data into language table
        $this->batchInsert('{{%language}}', ['id_language', 'name', 'code', 'status'], [
            [1, 'English', 'en', 1],
            [2, 'Hindi', 'hi', 1],
            [3, 'Bengali', 'bn', 1],
            [4, 'Marathi', 'mr', 1],
            [5, 'Telugu', 'te', 1],
            [6, 'Tamil', 'ta', 1],
            [7, 'Kannada', 'kn', 1],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }

}
