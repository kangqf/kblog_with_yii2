<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-10-17
 * Time: 12:05
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class TestAsset extends AssetBundle
{
    //@webroot=>project/frontend/web
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
       // 'css/article.css',
    ];

    public $js = [
        'js/webRTC/firebase.js',
        'js/webRTC/RTCMultiConnection.js',
    ];

    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}