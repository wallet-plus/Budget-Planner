<?php

use yii\db\Migration;

/**
 * Class m241220_101150_create_bt_customers
 */
class m241220_101150_create_bt_customers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create table
        $this->createTable('{{%bt_customer}}', [
            'id' => $this->primaryKey(),
            'id_customer_type' => $this->integer(1)->notNull(),
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'gender' => $this->string(1)->notNull()->comment('f: Female; m: Male'),
            'username' => $this->string(255)->notNull(),
            'image' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'otp' => $this->string(4)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'email_verification_code' => $this->string(255)->defaultValue(null),
            'email_verified' => $this->tinyInteger(1)->notNull(),
            'mobile_verification_code' => $this->string(255)->notNull(),
            'mobile_verified' => $this->tinyInteger(1)->notNull(),
            'ipaddress' => $this->string(50)->notNull(),
            'authKey' => $this->string(255)->notNull(),
            'date_created' => $this->dateTime()->notNull(),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'active' => $this->tinyInteger(1)->notNull()->comment('1: Enable; 0: Disable'),
            'offline_access' => $this->tinyInteger(1)->notNull()->comment('1: Enable; 0: Disable'),
            'email_notification' => $this->tinyInteger(1)->notNull()->comment('1: Enable; 0: Disable'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bt_customer}}');
    }

}
