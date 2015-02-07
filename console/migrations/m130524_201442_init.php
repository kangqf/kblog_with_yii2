<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    /**
     * 数据库初始化配置，创建一个config表
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /**
         * 初始化设置表
         */
        $this->createTable('{{%config}}', [
            'key' => Schema::TYPE_STRING . '(64) NOT NULL PRIMARY KEY',
            'value' => Schema::TYPE_TEXT . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%config}}');
    }
}
