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
        $guest = $auth->createRole('10'); // guest-访客-10
        $guest->description = 'guest-访客-10';
        $auth->add($guest);

        $user = $auth->createRole('9'); //user-用户-9
        $user->description = 'user-用户-9';
        $auth->add($user);
        $auth->addChild($user, $guest); // 用户 > 访客

        $orgleader = $auth->createRole('8'); //orgleader-经理（合伙人）-8
        $orgleader->description = 'orgleader-经理（合伙人）-8';
        $auth->add($orgleader);
        $auth->addChild($orgleader, $user); // 经理（合伙人） > 用户

        $fin = $auth->createRole('7'); //fin-财务-7
        $fin->description = 'fin-财务-7';
        $auth->add($fin);
        $auth->addChild($fin, $orgleader); // 财务 > 经理（合伙人）

        $analytic = $auth->createRole('6'); //analytic-数据分析师-6
        $analytic->description = 'analytic-数据分析师-6';
        $auth->add($analytic);
        $auth->addChild($analytic, $fin); // 数据分析师 > 财务

        $operator = $auth->createRole('5'); //operator-运营商-5
        $operator->description = 'operator-运营商-5';
        $auth->add($operator);
        $auth->addChild($operator, $analytic); // 运营商 > 数据分析师

        $manager = $auth->createRole('4'); //manager-经理-4
        $manager->description = 'manager-经理-4';
        $auth->add($manager);
        $auth->addChild($manager, $operator); // 经理 > 运营商

        $managleader = $auth->createRole('3'); //managleader-领导-3
        $managleader->description = 'managleader-领导-3';
        $auth->add($managleader);
        $auth->addChild($managleader, $manager); // 领导 > 经理

        $supermanager = $auth->createRole('2'); //supermanager-高级领导-2
        $supermanager->description = 'supermanager-高级领导-2';
        $auth->add($supermanager);
        $auth->addChild($supermanager, $managleader); // 高级领导 > 领导

        $admin = $auth->createRole('1'); // admin-管理员-1
        $admin->description = 'admin-管理员-1';
        $auth->add($admin);
        $auth->addChild($admin, $supermanager); // 管理员 > 高级领导

        $auth->addChild($admin, $visitAdmin); // 管理员可以访问后台

        $superadmin = $auth->createRole('0'); //superadmin-超级管理员-0
        $superadmin->description = '创始人';
        $auth->add($superadmin);
        $auth->addChild($superadmin, $admin); // 超级管理员 > 管理员

        $this->stdout("init success", Console::BG_GREEN);
        return true;
    }

}