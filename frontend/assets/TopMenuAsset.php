<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace frontend\assets;

use yii\web\AssetBundle;



class TopMenuAsset extends AssetBundle
{
     public $basePath = '@webroot';
     public $baseUrl = '@web';

     public $css = [
         'css/topMenu.css',
     ];
}