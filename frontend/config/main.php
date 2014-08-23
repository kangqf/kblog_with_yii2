<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    //require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'KBlog',  //app名称
    'defaultRoute'=>'kblog',	//添加以设置默认控制器 yii1中为defaultController
    'layout' => 'defaultLayout',      //修改默认布局文件


    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'params' => $params,

    'components' => [

        //将框架的view->themes托管给ThemeManager类
    	  'view'=>[
      		'theme' => [
      			'class'=>'common\models\ThemeManager',
      			'current' => 'default',
            'themes' => [
              'default' =>[
                'pathMap'   =>[
                    '@app/views'  => '@frontend/themes/default/views',
                    '@app/views/layouts' => '@frontend/themes/default/views/layouts',
                ],
              ],
            ],
          ],
        ],

        //路由管理
        'urlManager' => [
          //'enableStrictParsing' => true,
          //'suffix' => '.html',//伪URL后缀
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => [
              ['class' => 'yii\rest\UrlRule', 'controller' => 'visit'],
              ['class' => 'yii\rest\UrlRule', 'controller' => 'kblog'],

          ],
        ],
        //后台路由管理
        'urlManagerBackend' => [
          'class' => 'yii\web\urlManager',
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'suffix' => '.html',
          'baseUrl' => $params['backendDomain'],
          'hostInfo' => $params['backendDomain'],
          'rules' => [

          ],
        ],

        //第三方登陆验证扩展
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'tencent' => [
                    'class' => 'yii\authclient\clients\Tencent',
                    'clientId' => '101146332',
                    'clientSecret' => '2598941b11590a6d8b070e5408652b94',
                ],
                'weibo' => [
                    'class' => 'yii\authclient\clients\Weibo',
                    'clientId' => '2664841566',
                    'clientSecret' => 'e6ad2e1ae3dec5171e3fb5fb48073689',
                ],
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => '571dad80bddd6c978b55',
                    'clientSecret' => 'a0adb5d20e1e46323cbda39d80da3bb3b238af95',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOpenId'
                ],


            ],
        ],

        'errorHandler' => [
            'errorAction' => 'kblog/error',
        ],




        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '-d0CtO5UOtyeO3hSTkB9hVBXgFiD00wl',
        ],

        //验证的类
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



    ],
];
