<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * FontAwesome的资源包管理类
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class FontAwesomeAssets extends AssetBundle
{
    public $sourcePath = '@bower/adminlte';
    public $css = [
//        'css/AdminLTE.css',
    ];
    public $js = [
//        'js/AdminLTE/app.js',
    ];

    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset'
    ];
}