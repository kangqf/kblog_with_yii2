<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
use yii\helpers\Html;

$this->title = '完成注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup-finish">
    <h1><?= Html::encode($this->title) ?></h1>
    <br/>
    <?= $this->render('public/_info', ['model' => $model]); ?>
</div>