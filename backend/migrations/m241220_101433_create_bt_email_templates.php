<?php

use yii\db\Migration;

/**
 * Class m241220_101433_create_bt_email_templates
 */
class m241220_101433_create_bt_email_templates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create table
        $this->createTable('{{%bt_email_templates}}', [
            'id_email_template' => $this->primaryKey(),
            'title' => $this->string(255)->defaultValue(null),
            'email_template' => $this->text()->defaultValue(null),
            'create_by' => $this->integer()->defaultValue(null),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_by' => $this->integer()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Insert default data
        $this->insert('{{%bt_email_templates}}', [
            'id_email_template' => 1,
            'title' => 'Wallet Plus Email Template',
            'email_template' => '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <style>
              @media only screen and (max-width:640px) {
                table.w3l-scale {
                  width: 100% !important
                }
        
                td.w3l-scale-center {
                  width: 100% !important;
                  text-align: center !important
                }
              }
            </style>
          </head>
          <body style="margin:0;padding:0">
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="w3l-scale" style="background-color:#eaeced" width="100%">
              <tr>
                <td height="40" style="font-size:1px">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font-size:12px;font-size:12px;color:#999">
                  <a href="index.html" style="color:#000;font-size:40px;font-weight:700;font-family:helvetica,arial,sans-serif;text-decoration:none">WalletPlus</a>
                </td>
              </tr>
              <tr>
                <td height="25" style="font-size:1px">&nbsp;</td>
              </tr>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="w3l-scale" style="background-color:#eaeced" width="100%">
              <tr>
                <td>
                  <table align="center" border="0" cellpadding="0" cellspacing="0" style="background-color:#fff;border-radius:10px;overflow:hidden" class="w3l-scale-90" width="70%">
                    <tr>
                      <td height="50" style="background-color:#fff;font-size:1px">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" style="background-color:#fff">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="w3l-scale" width="65%">
                          template_subject_content
                          <tr>
                            <td height="20" style="font-size:1px">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center" class="w3l-scale-center-both" style="font-size:16px;line-height:24px;color:#233252;font-family:helvetica,arial,sans-serif">template_email_content</td>
                          </tr>
                          <tr>
                            <td height="60" style="font-size:1px">&nbsp;</td>
                          </tr>
                          template_button_content
                          <tr>
                            <td align="center" class="w3l-scale-center-both" height="50" style="font-size:13px;font-family:helvetica,arial,sans-serif;color:#666;line-height:24px">© 2023 WalletPlus.in.</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="w3l-scale" style="background-color:#eaeced" width="100%">
              <tr>
                <td height="70" style="font-size:1px">&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>',
            'create_by' => null,
            'created_at' => null,
            'updated_by' => null,
            'updated_at' => '2023-10-03 19:48:32',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop table
        $this->dropTable('{{%bt_email_templates}}');
    }
}
