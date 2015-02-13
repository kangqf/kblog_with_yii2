<?php

// 用于管理默认布局文件的资源包的类

namespace backend\assets;

use yii\web\AssetBundle;

class BackendLayoutAsset extends AssetBundle
{
    //@webroot=>project/frontend/web
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
       // 'css/defaultLayout.css',
    ];

    public $js = [
    ];

    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
