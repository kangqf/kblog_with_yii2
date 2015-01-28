<?php
return [
    'language' => 'zh-CN',          //全局语言
    'charset' => 'UTF-8',           //全局字符编码
    'timeZone' => 'Asia/Chongqing', //时区
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //授权管理
        'authManager' => [
            'class' => 'common\rbac\AuthManager',
            'defaultRoles' => ['10'],
        ],

    ],
];
