<?php

use yii\db\Schema;
use yii\db\Migration;

class m150212_050335_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%category}}', [
            'cgid' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . " NOT NULL DEFAULT 'category'",
            'level' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'visual_able' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'order' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'parent_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        echo "m150212_050335_create_category_table had been reverted.\n";
    }
}
