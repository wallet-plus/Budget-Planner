<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%professionals}}`.
 */
class m241122_233703_create_jamat_professionals_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('members', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(100)->notNull(),
            'last_name' => $this->string(100),
            'mobile_number' => $this->string(15)->notNull()->unique(),
            'email' => $this->string(255)->notNull()->unique(),
            'address' => $this->text(),
            'landmark' => $this->string(255),
            'latitude' => $this->decimal(10, 8),
            'longitude' => $this->decimal(11, 8),
            'profession_id' => $this->integer(),
            'four_months_in_jamat' => $this->boolean()->defaultValue(false),
            'forty_days_in_jamat' => $this->boolean()->defaultValue(false),
            'ten_days_in_jamat' => $this->boolean()->defaultValue(false),
            'three_days_in_jamat' => $this->boolean()->defaultValue(false),
            'bahrain_jamat' => $this->boolean()->defaultValue(false),
            'three_day_masturat' => $this->boolean()->defaultValue(false),
            'ten_day_masturat' => $this->boolean()->defaultValue(false),
            'forty_day_masturat' => $this->boolean()->defaultValue(false),
            'two_month_masturat' => $this->boolean()->defaultValue(false),
            'gush_timings' => "ENUM('Fajar', 'Zohar', 'Asar', 'Maghrib', 'Isha')",
        ]);

        $this->addForeignKey(
            'fk-members-profession_id',
            'members',
            'profession_id',
            'professionals',
            'id',
            'SET NULL'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-members-profession_id', 'members');
        $this->dropTable('members');
    }
}