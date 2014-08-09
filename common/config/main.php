<?php
return [

    'language' => 'zh-CN',  //全局语言
    'charset' => 'UTF-8',   //全局字符编码

    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [



        'cache' => ['class' => 'yii\caching\FileCache', ],
    ],
    

    'modules' => [
     'gridview' =>  [
          'class' => '\kartik\grid\Module'
      ]
    ],

];
