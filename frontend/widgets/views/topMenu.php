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


/** @var array $category 文章分类 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right','id' => 'category'],
    'encodeLabels' => false,
    'items' => $category
]);

/** @var array $searchForm 搜索框 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right','id' => 'searchForm'],
    'encodeLabels' => false,
    'items' => $searchForm
]);

/** @var array $userInfo 用户信息 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right','id' => 'userInfo'],
    'encodeLabels' => false,
    'items' => $userInfo
]);

NavBar::end();