<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\common\controllers',
   // 'defaultRoute' => 'api', //添加以设置默认控制器 yii1中为defaultController

    'modules' => [
        'v1' => [
            'class' => 'api\versions\v1\Module',
        ],
        'v2' => [
            'class' => 'api\versions\v2\Module',
        ],
    ],

    'components' => [
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
        'urlManager' => [
            //'enableStrictParsing' => true,
            //'suffix' => '.html',//伪URL后缀
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/user', 'v1/post']
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v2/user', 'v2/post']
                ],
            ],
        ],
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        // //    'enableStrictParsing' => true,
        //     'showScriptName' => false,

        //  ],
    ],
    'params' => $params,
];
