<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-9-30
 * Time: 上午11:07
 */

// 用于管理文章详情首页的资源包的类

namespace frontend\assets;

use yii\web\AssetBundle;

class ArticleAsset extends AssetBundle
{
    //@webroot=>project/frontend/web
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/article.css',
    ];

    public $js = [
    ];

    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}