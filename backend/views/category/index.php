<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Category;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CategorySearch $searchModel
 */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php  //echo Html::a('Create Category', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'beforeGrid'=>'',
            'afterGrid'=>'',
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],//序号

          //  'cgid',

            [
                'attribute' => 'level',
                'value' => function ($model) {
                        return $model->level?'二级':'一级';
                    },
                'filter' => Html::activeDropDownList($searchModel, 'level', Category::getLevelArray(), ['class' => 'form-control', 'prompt' => ''])
            ],

           // 'level',
           // 'name',
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function ($model) {
                        return Html::a($model->name,
                            Yii::$app->urlManager->createUrl(['category/update','id' => $model->cgid,]),
                            ['title' => Yii::t('yii', 'Edit'),]
                        );
                    },
            ],
          //  'status',
            [
                'attribute' => 'visual_able',
                'value' => function ($model) {
                        return $model->visual_able?'可见':'不可见';
                    },
                'filter' => Html::activeDropDownList($searchModel, 'visual_able', Category::getVisualEnableArray(), ['class' => 'form-control', 'prompt' => ''])
            ],
          //  'visual_able',

          //  'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                        if(!$model->parent_id)
                            return'顶级菜单';
                        else{
                            return Category::getParentName($model->parent_id)->name;
                        }
                    },
                'filter' => Html::activeDropDownList($searchModel, 'parent_id', Category::getCategoryArray(), ['class' => 'form-control', 'prompt' => ''])
            ],

//            [
//                'class' => 'yii\grid\DataColumn', // can be omitted, default
//                'value' => function ($data) {
//                        return $data->name;
//                    },
//            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                         return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                         Yii::$app->urlManager->createUrl(['category/view','id' => $model->cgid,'edit'=>'t']),
                                         ['title' => Yii::t('yii', 'Edit'),]
                                        );
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
