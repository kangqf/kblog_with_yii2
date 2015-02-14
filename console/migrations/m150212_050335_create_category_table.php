<?php

use yii\db\Schema;
use yii\db\Migration;

class m150212_050335_create_category_table extends Migration
{
    const TBL_NAME = '{{%category}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TBL_NAME, [
            'cgid' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . " NOT NULL DEFAULT 'category'",
            'level' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'visual_able' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'order' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'parent_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'created_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_category_parent', self::TBL_NAME, '[[parent_id]]',
            self::TBL_NAME, '[[cgid]]', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_category_created_by', self::TBL_NAME,
            '[[created_by]]', '{{%user}}', '[[user_id]]', 'RESTRICT', 'CASCADE');
        /* void addForeignKey( $name, $table, $columns, $refTable, $refColumns, $delete = null, $update = null )
         * 当 $refTable -> $refColumns 被 删除 和 更新 时 $table -> $columns 所要进行的操作
         * cascade方式 在父表上update/delete记录时，同步update/delete掉子表的匹配记录
         * Restrict方式同no action, 都是立即检查外键约束,即当外键删除时确保不被任何其他行引用
         */

    }

    public function down()
    {
        $this->dropTable(self::TBL_NAME);
        echo "m150212_050335_create_category_table had been reverted.\n";
    }
}
