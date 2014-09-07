<?php
return [

    'language' => 'zh-CN',  //全局语言
    'charset' => 'UTF-8',   //全局字符编码
    'timeZone' => 'Asia/Chongqing',//时区

    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [


        //授权管理
        'authManager' => [
            //'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
            //'authFile' => '@app/runtime/rbac.php'
//            'itemFile' => '@vova07/rbac/data/items.php',
//            'assignmentFile' => '@vova07/rbac/data/assignments.php',
//            'ruleFile' => '@vova07/rbac/data/rules.php',
            // 'defaultRoles' => ['guest'],
        ],

        'cache' => ['class' => 'yii\caching\FileCache', ],

          //使用MongoDB 的配置
         'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://kqf:kqf911@localhost:27017/kblog',
          ],
    ],
    //
    //  'controllerMap' => [
    //     [
    //         'account' => 'app\controllers\UserController',
    //         'article' => [
    //             'class' => 'app\controllers\PostController',
    //             'enableCsrfValidation' => false,
    //         ],
    //     ],
    // ],

    'modules' => [

      //  'gridview' =>  [
      //       'class' => '\kartik\grid\Module'
      //   ],
      //
      //  'datecontrol' =>  [
      //     'class' => 'kartik\datecontrol\Module',
      //
      //     // format settings for displaying each date attribute
      //     'displaySettings' => [
      //         'date' => 'd-m-Y',
      //         'time' => 'H:i:s A',
      //         'datetime' => 'd-m-Y H:i:s A',
      //     ],
      //
      //     // format settings for saving each date attribute
      //     'saveSettings' => [
      //         'date' => 'Y-m-d',
      //         'time' => 'H:i:s',
      //         'datetime' => 'Y-m-d H:i:s',
      //     ],
      //
      //     // automatically use kartik\widgets for each of the above formats
      //     'autoWidget' => true,
      //
      // ]
    ],




];
