<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * 用于管理后台默认布局文件的资源包的类
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class BackendLayoutAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
//        'css/frontendLayout.css',
//        'css/ihover/khover.css '
    ];

    public $js = [
    ];

    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
