<?php
return [
    'language' => 'zh-CN',          //全局语言
    'charset' => 'UTF-8',           //全局字符编码
    'timeZone' => 'Asia/Chongqing', //时区
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        //用户验证的组件
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/signin'],
            //'loginUrl' => [ \Yii::$app->homeUrl . '/signin'],
        ],
        //缓存管理的组件
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //授权管理
        'authManager' => [
            'class' => 'common\rbac\AuthManager',
            'defaultRoles' => ['10'],
        ],
        //国际化的组件
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
//                        'app' => 'app.php',
//                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],


    ],
];
