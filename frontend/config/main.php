<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'KBlog',              //app名称
    'defaultRoute' => 'frontend',   //添加以设置默认控制器 yii1中为defaultController
    'layout' => 'frontendLayout',    //修改默认布局文件
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'controllerMap' => [
        'article' => [
            'class' => 'app\controllers\PostController',
            'enableCsrfValidation' => false,
        ],
    ],
    'components' => [
        //日志写入组件
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        //错误处理组件
        'errorHandler' => [
            'errorAction' => 'frontend/error',
        ],
        //路由管理组件
        'urlManager' => [
            //'enableStrictParsing' => true,
            //'suffix' => '.html',//伪URL后缀
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'visit'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'kblog'],

                'signin' => '/frontend/login',
                'signup' => '/frontend/register',
                'signout' => '/frontend/logout',
                'request-password-reset' => '/frontend/request-password-reset',
                'reset-password' => '/frontend/reset-password',
                'auth' => '/frontend/auth',


            ],
        ],
    ],
    'params' => $params,        //生成变量组件
];
