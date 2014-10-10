<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
use common\models\Category;
use common\models\Article;



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
          //  'author_id',
            [
                'attribute' => 'author_id',
                'value' => function ($model) {
                      //  dump($model);die();
                        return User::getNameById($model->author_id);
                    },
              //  'filter' => Html::activeInput($searchModel, 'author_id', User::getStatusArray(), ['class' => 'form-control','style'=>'width:100px' ,'prompt' => ''])
            ],
         //   'category_id',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                        return Category::getAllCategoryArray()[$model->category_id];
                    },
                 'filter' => Html::activeDropDownList($searchModel, 'category_id', Category::getAllCategoryArray(), ['class' => 'form-control','style'=>'width:100px' ,'prompt' => ''])
            ],
            'title',
//            'content:ntext',
//            'tags:ntext',
//            'keywords:ntext', 
//            'summary', 
          //  'set_index',
            [
                'attribute' => 'set_index',
                'value' => function ($model) {
                        return Article::getYNArray()[$model->set_index];
                    },
                'filter' => Html::activeDropDownList($searchModel, 'set_index',  Article::getYNArray(), ['class' => 'form-control','style'=>'width:100px' ,'prompt' => ''])
            ],
         //   'set_top',
            [
                'attribute' => 'set_top',
                'value' => function ($model) {
                        return Article::getYNArray()[$model->set_top];
                    },
                'filter' => Html::activeDropDownList($searchModel, 'set_top',  Article::getYNArray(), ['class' => 'form-control','style'=>'width:100px' ,'prompt' => ''])
            ],
         //   'set_recommend',
            [
                'attribute' => 'set_recommend',
                'value' => function ($model) {
                        return Article::getYNArray()[$model->set_recommend];
                    },
                'filter' => Html::activeDropDownList($searchModel, 'set_recommend',  Article::getYNArray(), ['class' => 'form-control','style'=>'width:100px' ,'prompt' => ''])
            ],
            'click_count',
        //    'status',
           'created_time:datetime',
//            [
//                'attribute' => 'created_time',
//               // 'hidden'=>true,
//             //   'format'=>['date', 'dd-MMM-Y'],
//                'filterType'=>GridView::FILTER_DATE,
//              //  'filter' => GridView::FILTER_DATE($searchModel, 'set_recommend',  Article::getYNArray(), ['class' => 'form-control','style'=>'width:100px' ,'prompt' => ''])
//            ],
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
