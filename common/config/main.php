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
            'loginUrl' => [Yii::$app->homeUrl . '/signin'],
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
        //文件系统组件
        'fileSystem' => [
            'class' => 'callmez\file\system\Collection',
            'fileSystems' => [
                //根据需求可设置多个存储, 以下来使用例子
                'local' => function() {
                    return new \callmez\file\system\FileSystem(
                        new \callmez\file\system\adapters\Local(\Yii::getAlias('@upload/images'))
                    );
                },
                'qiniu' => function() {
                    return new \common\compoents\FileSystem(
                        new \common\compoents\Qiniu(
                            'kangqingfei',
                            'sumxVFQJtnjrUDjd9puCc3EEWDqTbTiwAp8Lcy8L',
                            'TBmIgg2Nm8JXdX9D_Qx1AI7rlQUMw2PMHZ0be7An'
                            //'七牛的空间域名,默认为 {bucket}.qiniu.com 选填'
                        )
                    );
                }
            ]
        ],

    ],
];
