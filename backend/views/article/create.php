<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Article',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
