<?php
return [

    'language' => 'zh-CN', //全局语言
    'charset' => 'UTF-8', //全局字符编码
    'timeZone' => 'Asia/Chongqing', //时区

    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        //授权管理
        'authManager' => [
            'class' => 'common\rbac\components\PhpManager', // 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
//            'itemFile' => '@vova07/rbac/data/items.php',
//            'assignmentFile' => '@vova07/rbac/data/assignments.php',
//            'ruleFile' => '@vova07/rbac/data/rules.php',
            'defaultRoles' => ['10'],
        ],

        'cache' => ['class' => 'yii\caching\FileCache',],

        //使用MongoDB 的配置
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://121.40.120.73:27017/kblog',
        ],
    ],

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

        /* markDown模块 */
        'markdown' => [
            'class' => 'kartik\markdown\Module',

            // the controller action route used for markdown editor preview
            'previewAction' => '/markdown/parse/preview',

            // the controller action route used for downloading the markdown exported file
            'downloadAction' => '/markdown/parse/download',

            // the list of custom conversion patterns for post processing
            'customConversion' => [
                '<table>' => '<table class="table table-bordered table-striped">'
            ],

            // whether to use PHP SmartyPantsTypographer to process Markdown output
            'smartyPants' => true,

            // array the the internalization configuration for this module
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@markdown/messages',
                'forceTranslation' => true
            ],
        ],

        //gridview组件
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],


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
