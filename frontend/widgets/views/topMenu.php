<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
/**
 * 导航栏视图文件
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\TopMenuAsset;

TopMenuAsset::register($this);

NavBar::begin
([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => $options['brandUrl'],
    'brandOptions' => ['id' => 'brand', 'class' => 'pull-left',],
    'options' => ['class' => 'navbar-inverse', 'id' => 'navbar'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => $category
]);

NavBar::end();