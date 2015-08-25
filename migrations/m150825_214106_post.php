<?php

use yii\db\Schema;
use yii\db\Migration;

class m150825_214106_post extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%post}}', [
            'id'          => Schema::TYPE_PK,

            'title'       => Schema::TYPE_STRING . '(128) NOT NULL',
            'text'        => Schema::TYPE_TEXT . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'img'         => Schema::TYPE_STRING . '(128) NOT NULL',
            'status'      => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',

            'created_at'  => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'  => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }
    
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }

}
