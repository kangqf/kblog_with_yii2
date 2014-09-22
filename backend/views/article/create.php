<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 */

$this->title = Yii::t('app', '添加 {modelClass}', [
  'modelClass' => 'Article',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">
    <div class="page-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
