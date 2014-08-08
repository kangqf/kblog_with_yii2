<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        //'Kfunction' => ['class' => 'common\components\Kfunction'],

        'cache' => ['class' => 'yii\caching\FileCache', ],
    ],

    'modules' => [
     'gridview' =>  [
          'class' => '\kartik\grid\Module'
      ]
    ],

];
