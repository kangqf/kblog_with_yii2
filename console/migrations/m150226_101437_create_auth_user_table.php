<?php

use yii\db\Schema;
use yii\db\Migration;

class m150226_101437_create_auth_user_table extends Migration
{
    const TBL_NAME = '{{%auth_user}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TBL_NAME, [
            'auth_user_id' => Schema::TYPE_STRING . " NOT NULL DEFAULT 'auth_id'",
            'type' => Schema::TYPE_STRING . " NOT NULL DEFAULT 'type'",
            'uid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'detail_info_id' => Schema::TYPE_STRING . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);
        $this->addPrimaryKey('pk_auth_user_uid', self::TBL_NAME, ['auth_user_id','type']);
        $this->addForeignKey('fk_auth_user_uid', self::TBL_NAME, '[[uid]]',
            '{{%user}}', '[[user_id]]', 'RESTRICT', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable(self::TBL_NAME);
        echo "m150226_101437_create_auth_user_table had been reverted.\n";
    }
}
