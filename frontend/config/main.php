<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'kblog',  //app名称
    'defaultRoute'=>'kblog',	//添加以设置默认控制器 yii1中为defaultController
    'layout' => 'defaultLayout',      //修改默认布局文件


    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'params' => $params,

    'components' => [

            //将框架的views托管给ThemeManager类
    	  'view'=>[
      		'theme' => [
      			'class'=>'common\models\ThemeManager',
      			'current' => 'default',
            'themes' => [
              'default'  =>[
                'pathMap'   =>[
                    '@app/views'    =>  '@frontend/themes/default/views',
                    '@app/views/layouts'    =>  '@frontend/themes/default/views/layouts',
                ],
              ],
            ],
          ],
        ],

              //伪URL后缀
        'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'suffix' => '.html',
          'rules' => [
              ['class' => 'yii\rest\UrlRule', 'controller' => 'kblog'],

          ],
        ],

        'urlManagerBackend' => [
          'class' => 'yii\web\urlManager',
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'suffix' => '.html',
          'baseUrl' => 'http://www.aaa.com',
          'hostInfo' => 'http://www.aaa.com',
            'rules' => [

              
                ]

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
            'errorAction' => 'kblog/error',
        ],

    ],
];
