<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\UserSearch $searchModel
 */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // echo Html::a('Create User', ['create'], ['class' => 'btn btn-success'])  ?>
    </p>

    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'uid',
            'username',
            'email:email',
//            'password',
//            'avatar',
//            'created_time:datetime',
//            'updated_time:datetime',
            'login_count',
            'status',
            'role',
            'open_id',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',

            [
                'class' => 'kartik\grid\ActionColumn',


                'buttons' => [
                    'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                Yii::$app->urlManager->createUrl(['user/view', 'id' => $model->uid, 'edit' => 't']),
                                ['title' => Yii::t('yii', 'Edit'),]
                            );
                        }

                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'bordered' => false,
        'striped' => false,
        'condensed' => false,

        // 'pageSummary' => false,
        // 'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        // 'pjax' => true, // pjax is set to always true for this demo
//        'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
//        'showPageSummary' => true,


        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);

    Pjax::end(); ?>

</div>
