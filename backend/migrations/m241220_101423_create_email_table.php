<?php

use yii\db\Migration;

/**
 * Class m241220_101423_create_email
 */
class m241220_101423_create_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create table
        $this->createTable('{{%email}}', [
            'id_email' => $this->primaryKey(),
            'name' => $this->string(255)->defaultValue(null),
            'id_email_template' => $this->integer()->defaultValue(null),
            'email_content' => $this->text()->notNull(),
            'from_name' => $this->string(255)->defaultValue(null),
            'from_email' => $this->string(255)->defaultValue(null),
            'subject' => $this->string(255)->defaultValue(null),
            'cc_email' => $this->string(255)->defaultValue(null),
            'create_by' => $this->integer()->defaultValue(null),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_by' => $this->integer()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Insert default data
        $this->batchInsert('{{%email}}', [
            'id_email', 
            'name', 
            'id_email_template', 
            'email_content', 
            'from_name', 
            'from_email', 
            'subject', 
            'cc_email', 
            'create_by', 
            'created_at', 
            'updated_by', 
            'updated_at'
        ], [
            [1, 'Welcome Email', 1, 'We are excited to welcome you to Wallet Plus, the ultimate financial management tool designed to help you keep track of your expenses, budget, and savings. With Wallet Plus, you can easily manage your money and achieve your financial goals.<br/> Thank you for choosing Wallet Plus.', 'Wallet Plus', 'donotreply@walletplus.in', 'Welcome to Wallet Plus', 'info@walletplus.in', null, null, null, '2023-03-18 20:08:47'],
            [3, 'Email Verification', 1, 'You registered an account on WalletPlus, before being able to use your account you need to verify that this is your email address by clicking verify Email', 'Wallet Plus', 'donotreply@walletplus.in', 'WalletPlus Email Verification', 'info@walletplus.in', null, null, null, '2023-03-18 19:45:46'],
            [4, 'Login', 1, 'We noticed a new sign-in to your WalletPlus Account. If this was you, you don’t need to do anything. If not, we’ll help you secure your account.', 'Wallet Plus', 'donotreply@walletplus.in', 'Login', 'info@walletplus.in', null, null, null, '2023-03-18 19:46:16'],
            [5, 'Forgot Password', 1, 'Resetting your password is easy.<br /> Just press the button below and enter your new password.', 'Wallet Plus', 'donotreply@walletplus.in', 'Forgot Password ?', 'info@walletplus.in', null, null, null, '2023-03-22 06:52:34'],
            [6, 'Password Updated Successfully', 1, 'We are writing to inform you that your password has been successfully updated on our system. Your account security is our top priority, and we encourage you to regularly update your password to ensure its safety.<br /> Please note that your new password is encrypted and cannot be accessed by anyone, including our system administrators. Therefore, we advise you to keep your password safe and avoid sharing it with anyone.', 'Wallet Plus', 'donotreply@walletplus.in', 'Reset Password', 'info@walletplus.in', null, null, null, '2023-03-18 19:50:51'],
            [8, 'Email Verified Successfully', 1, 'We are writing to inform you that your email address has been successfully verified on our system. This is an important step in ensuring the security of your account and enables us to communicate important information with you.<br /> Thank you for taking the time to verify your email address. We appreciate your cooperation in ensuring the safety of your account.', 'Wallet Plus', 'donotreply@walletplus.in', 'Email Verified Successfully', 'info@walletplus.in', null, null, null, '2023-03-18 19:52:11'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop table
        $this->dropTable('{{%email}}');
    }

}
