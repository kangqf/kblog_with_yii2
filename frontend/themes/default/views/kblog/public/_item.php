<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-9-23
 * Time: 下午3:58
 */

use common\models\User;
use yii\helpers\Html;
use yii\helpers\StringHelper;

//  Html::img( Yii::$app->homeUrl . 'image/1.jpg' ,['class' => 'file-preview-image', 'alt' => '没找到默认头像', 'title' => '默认头像']);

/**
 * @var yii\web\View $this
 * @var app\models\Item $model
 */
?>

<div class="col-md-6">

    <!-- colored -->
    <div class="ih-item square effect14 ">
        <a href="/">
            <div class="img">
                <h3><?= $model->title ?></h3>
                <p><?php  echo $model->content;//StringHelper::truncate( ?></p>
            </div>
            <div class="info">
                <h3><?= User::getNameById($model->author_id) ?></h3>
                <p>点击：<?= $model->click_count ?></p>
                <p>评论：<?= $model->comment_count ?></p>
                <p>时间：<?= date("Y-m-d H:i",$model->updated_time); ?></p>
            </div>
        </a>
    </div>
    <!-- end colored -->

</div>

