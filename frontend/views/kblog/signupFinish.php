<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-8-30
 * Time: 下午2:49
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