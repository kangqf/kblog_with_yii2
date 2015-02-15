<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('category', 'Update'), ['update', 'id' => $model->cgid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('category', 'Delete'), ['delete', 'id' => $model->cgid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('category', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cgid',
            'name',
            'level',
            'visual_able',
            'order',
            'parent_id',
            'created_at',
            'updated_at',
            'created_by',
        ],
    ]) ?>

</div>
