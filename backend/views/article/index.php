<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\ArticleSearch $searchModel
 */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Article',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'class' => '\kartik\grid\CheckboxColumn',
//                'contentOptions' => ['class' => 'kv-row-select'],
//                'headerOptions' => ['class' => 'kv-all-select'],
//            ],

    //        'aid',
            'author_id',
            'category_id',
            'title',
//            'content:ntext',
//            'tags:ntext',
//            'keywords:ntext', 
//            'summary', 
            'set_index',
            'set_top',
            'set_recommend',
            'click_count',
            'status',
            'created_time:datetime',
            'updated_time:datetime',

            [
                'class' => 'kartik\grid\ActionColumn',
                'buttons' => [
                'update' => function ($url, $model) {
                     return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                         Yii::$app->urlManager->createUrl(['article/view','id' => $model->aid,'edit'=>'t']),
                         [ 'title' => Yii::t('yii', 'Edit'),]);
                    }
                ],
            ],
        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>true,




        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]);

    Pjax::end(); ?>

</div>
