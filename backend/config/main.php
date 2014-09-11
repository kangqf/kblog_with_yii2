<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    //require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
//require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'KBlogBackend',
    'name' => 'KAdmin',


    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],


    //yii2-admin所用组件 除了allowActions里面的内容全部都需要经过这里的检查
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*',
            // 'admin/*', // add or remove allowed actions to this list
            //  'site/*',
        ],
    ],

    //模块
    'modules' => [

        //yii2所用模块https://github.com/mdmsoft/yii2-admin
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // or right-menu
//            'allowActions' => [
//                '*'
//            ],
        ],
    ],

    'components' => [

        //用户验证的类
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'],
        ],

        //路由控制器
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'suffix' => '.html',
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'site'],

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
            'rules' => [

            ],
        ],


        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '-d0CtO5UOtyeO3hSTkB9hVBXgFiD00wl',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],

    'params' => $params,

];
