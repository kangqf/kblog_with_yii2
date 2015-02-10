<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
namespace frontend\assets;

use yii\web\AssetBundle;



/**
 * 导航栏的资源管理
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class TopMenuAsset extends AssetBundle
{
     public $basePath = '@webroot';
     public $baseUrl = '@web';

     public $css = [
         'css/topMenu.css',
     ];
}