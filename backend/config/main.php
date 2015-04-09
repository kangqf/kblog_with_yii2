<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'KBlog-Admin',              //app名称
    'defaultRoute' => 'backend',
    'layout' => 'backendLayout',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // 错误处理组件
        'errorHandler' => [
            'errorAction' => 'backend/error',
        ],
        // 路由管理组件
        'urlManager' => [
            //'enableStrictParsing' => true,
            //'suffix' => '.html',//伪URL后缀
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:(index|auth|)>' => 'backend/<action>',
                'signin' => '/backend/login',
                'signout' => '/backend/logout',
            ],
        ],
        //前台路由管理
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'suffix' => '.html',
            'baseUrl' => $params['frontendDomain'],
            'hostInfo' => $params['frontendDomain'],
            'rules' => [],
        ],
    ],
    'params' => $params,
];
