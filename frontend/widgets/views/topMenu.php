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

/** @var array $category frontend\widgets\TopMenu 文章分类 */
/** @var array $searchForm frontend\widgets\TopMenu 搜索框 */
/** @var array $userInfo frontend\widgets\TopMenu 用户信息 */

TopMenuAsset::register($this);

NavBar::begin
([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => $options['brandUrl'],
    'brandOptions' => ['id' => 'brand', 'class' => 'pull-left',],
    'options' => ['class' => 'navbar-inverse', 'id' => 'navbar'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right','id' => 'category'],
    'encodeLabels' => false,
    'items' => $category
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right','id' => 'searchForm'],
    'encodeLabels' => false,
    'items' => $searchForm
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right','id' => 'userInfo'],
    'encodeLabels' => false,
    'items' => $userInfo
]);
NavBar::end();