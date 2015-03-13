<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

use yii\helpers\Html;

/**
 * 注册页面
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var frontend\models\RegisterForm $model
 */
$this->title = isset($title) ? $title : '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register">
    <h1><?= Html::encode($this->title) ?></h1>
    <br/>
    <?= $this->render('public/_info', ['model' => $model]); ?>

</div>