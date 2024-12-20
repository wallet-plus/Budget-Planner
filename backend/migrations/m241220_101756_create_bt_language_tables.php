<?php

use yii\db\Migration;

/**
 * Class m241220_101756_create_bt_language_tables
 */
class m241220_101756_create_bt_language_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create bt_language table
        $this->createTable('bt_language', [
            'id_language' => $this->integer(11)->notNull(),
            'name' => $this->string(200)->defaultValue(null),
            'code' => $this->string(2)->notNull(),
            'status' => $this->integer(1)->defaultValue(null)->comment('1:Enable;0:Disable'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci');

        // Insert data into bt_language table
        $this->batchInsert('bt_language', ['id_language', 'name', 'code', 'status'], [
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
        $this->dropTable('bt_language');
    }

}
