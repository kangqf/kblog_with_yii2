<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>true,
            'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
            'panel'=>[
            'heading'=>$this->title,
            'type'=>DetailView::TYPE_INFO,
            'hAlign' =>'center',
        ],

        'attributes' => [
         //   'cgid',
            ['attribute'=>'level', 'type'=>DetailView::INPUT_DROPDOWN_LIST],
           // 'level',
            'name',
            'status',
            'visual_able',
            'parent_id',
        ],

        'deleteOptions'=>[
            'url'=>['delete', 'id' => $model->cgid],
            'data'=>[
            'confirm'=> '你确定要删除这一项?',
            'method'=>'post',
            ],
        ],

        'enableEditMode'=>true,
    ]) ?>

</div>
