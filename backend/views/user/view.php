<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

use common\models\User;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = $model->uid;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="page-header">
        <h1><?php //echo Html::encode($this->title) ?></h1>
    </div>


    <?=
    DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
        //    'uid',
            'username',
            'email:email',
            'password',
         //   'avatar',
        //    'created_time:datetime',
        //    'updated_time:datetime',
        //    'login_count',
        //    'status',
            ['attribute'=>'status','items' => User::getStatusArray(), 'type'=>DetailView::INPUT_DROPDOWN_LIST],
        //    'role',
            ['attribute'=>'role','items' => User::getRoleArray(), 'type'=>DetailView::INPUT_DROPDOWN_LIST],
         //   'open_id',
            'auth_key',
        //    'password_hash',
            'password_reset_token',
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->uid],
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ],
        'enableEditMode' => true,
    ]) ?>

</div>
