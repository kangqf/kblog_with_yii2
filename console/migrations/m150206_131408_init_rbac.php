<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

use yii\helpers\Console;

/**
 * 引入自带rbac数据库迁移文件
 */
require Yii::getAlias('@yii/rbac/migrations/m140506_102106_rbac_init.php');

/**
 * rbac数据库创建
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class m150206_131408_init_rbac extends m140506_102106_rbac_init
{

    /**
     * 使用父类方法初始化表后进行数据初始化
     * 也可以在Console中完成数据的初始化
     */
    public function up()
    {
        parent::up();
    }

    /**
     * 使用父类方法撤销 migrate
     */
    public function down()
    {
        parent::down();
    }
}
