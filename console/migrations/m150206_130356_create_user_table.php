<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

use yii\db\Schema;
use yii\db\Migration;

class m150206_130356_create_user_table extends Migration
{
    const TBL_NAME = '{{%user}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        /**
         * 用户表
         */
        $this->createTable(self::TBL_NAME, [
            'user_id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'avatar' => Schema::TYPE_STRING . ' NOT NULL',
            'login_count' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 ',
            'access_token' => Schema::TYPE_STRING . ' NOT NULL',
//            'oauth_id' => Schema::TYPE_STRING . ' NOT NULL',
//            'developer_id'  => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
        ], $tableOptions);
        $this->createIndex('username', self::TBL_NAME, ['username'],true);
        $this->createIndex('email', self::TBL_NAME, ['email'],true);
    }

    public function down()
    {
        $this->dropTable(self::TBL_NAME);
        echo "m150206_130356_create_user_table had been reverted.\n";
    }
}
