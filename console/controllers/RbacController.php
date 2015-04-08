<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Console;

/**
 * RBAC管理的命令
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class RbacController extends Controller
{
    /**
     * 默认方法
     * @internal param string $message the message to be echoed.
     */
    public function actionIndex()
    {
//        echo $this->ansiFormat('This will be red and underlined.', Console::FG_RED, Console::UNDERLINE);
//        $this->stdout('This will be red and underlined.', Console::FG_RED, Console::UNDERLINE);
//        $this->stderr('This will be red and underlined.', Console::FG_RED, Console::UNDERLINE);
        $tips = "RBAC Control \n    use yii rbac/init to init your rbac data to the database \n";
        $this->stdout($tips);

    }

    public function actionInit()
    {
        $this->stdout("Init start \n");
        $flag = false;
        $flag = $this->rbacInit();
        if(!$flag)
            $this->stderr("init failed", Console::FG_RED);
    }

    /**
     * 初始化 RBAC 默认设置
     */
    public function rbacInit()
    {
        Console::output('    start init RBAC data ....');
        $auth = \Yii::$app->authManager;

        // 权限
        $visitAdmin = $auth->createPermission('visitBackend');
        $visitAdmin->description = '访问后台管理界面';
        $auth->add($visitAdmin);

        // 身份
        $guest = $auth->createRole('10'); // 匿名用户
        $guest->description = 'guest 匿名用户';
        $auth->add($guest);

        $user = $auth->createRole('9'); //普通用户
        $user->description = '普通用户';
        $auth->add($user, $guest); //普通用户 > 匿名用户

        $admin = $auth->createRole('1'); // 管理员
        $admin->description = '管理员';
        $auth->add($admin);
        $auth->addChild($admin, $user); // 管理员 > 普通用户
        $auth->addChild($admin, $visitAdmin); // 管理员可以访问后台

        $founder = $auth->createRole('0'); // 创始人
        $founder->description = '创始人';
        $auth->add($founder);
        $auth->addChild($founder, $admin); // 创始人 > 管理员

        $this->stdout("init success", Console::BG_GREEN);
        return true;
    }

}