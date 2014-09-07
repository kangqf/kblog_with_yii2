<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    //require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],


    //yii2-admin所用组件
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'admin/*', // add or remove allowed actions to this list
        ],
    ],

    //模块
    'modules' => [

        //https://github.com/mdmsoft/yii2-admin
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // or right-menu
            'allowActions' => [
                '*'
            ],
        ],


    ],
    'components' => [

        //路由控制器
        'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
            // 'suffix' => '.html',
            'rules' => [
              ['class' => 'yii\rest\UrlRule', 'controller' => 'kblog'],

          ],
        ],


        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '-d0CtO5UOtyeO3hSTkB9hVBXgFiD00wl',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
