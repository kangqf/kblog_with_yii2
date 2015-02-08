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

    /**
     * 初始化 RBAC 默认设置
     */
    public function rbacInit()
    {
        Console::output('create rbac table success, start init RBAC data ....');
        $auth = Yii::$app->authManager;

        /**
         * 写入原始的 RBAC 数据
         */
        $visitAdmin = $auth->createPermission('visitAdmin');
        $visitAdmin->description = '访问后台管理界面';
        $auth->add($visitAdmin);

        /* ================= 身份 ================= */
        $guest = $auth->createRole('guest'); // 匿名用户
        $guest->description = '匿名用户';
        $auth->add($guest);

        $user = $auth->createRole('user'); //普通用户
        $user->description = '普通用户';
        $auth->add($user, $guest); //普通用户 > 匿名用户

        $admin = $auth->createRole('admin'); // 管理员
        $admin->description = '管理员';
        $auth->add($admin);
        $auth->addChild($admin, $user); // 管理员 > 普通用户
        $auth->addChild($admin, $visitAdmin); // 管理员可以访问后台

        $founder = $auth->createRole('founder'); // 创始人
        $founder->description = '创始人';
        $auth->add($founder);
        $auth->addChild($founder, $admin); // 创始人 > 管理员

        Console::output('init RBAC data success ....');
    }
}
