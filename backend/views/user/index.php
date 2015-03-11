<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Users Manage');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            'username',
            //'auth_key',
            //'email:email',
            // 'password',
            // 'password_hash',
            // 'password_reset_token',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'Y-M-d']
            ],
            // 'created_at',
            // 'updated_at',
            'role',
            'status',
            'auth_user.type',
            // 'avatar',
            'login_count',
            // 'access_token',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['user/view', 'id' => $model->user_id, 'edit' => 't']),
                            ['title' => Yii::t('yii', 'Edit'),]
                        );
                    }

                ],
            ],
            //['class' => 'yii\grid\ActionColumn'],
            //[ 'class' => 'yii\grid\CheckboxColumn',],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

    <p>
        <?php //Html::a(Yii::t('user', 'Create {modelClass}', ['modelClass' => 'User',]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
