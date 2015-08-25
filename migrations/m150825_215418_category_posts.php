<?php

use yii\db\Schema;
use yii\db\Migration;

class m150825_215418_category_posts extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category_posts}}', [
            'post_id'     => Schema::TYPE_INTEGER,
            'category_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->createIndex('FK_category', '{{%category_posts}}', 'category_id');
        $this->addForeignKey(
            'FK_category_post', '{{%category_posts}}', 'category_id', '{{%category}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_post', '{{%category_posts}}', 'post_id');
        $this->addForeignKey(
            'FK_post_category', '{{%category_posts}}', 'post_id', '{{%post}}', 'id', 'SET NULL', 'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%category_posts}}');
    }
}
