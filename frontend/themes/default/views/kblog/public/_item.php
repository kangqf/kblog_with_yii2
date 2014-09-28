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

    <!-- end colored -->


    <div class="ih-item square effect15 bottom_to_top">
        <a href="/login">
            <div class="img">
                <h3>1515<?= $model->title ?></h3>
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
    <div class="ih-item square effect14 right_to_left">
        <a href="/">
            <div class="img">
                <h3>1414<?= $model->title ?></h3>
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

    <div class="ih-item square effect13 right_to_left">
        <a href="/">
            <div class="img">
                <h3>1313<?= $model->title ?></h3>
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

    <div class="ih-item square effect12 top_to_bottom">
        <a href="/">
            <div class="img">
                <h3>1212<?= $model->title ?></h3>
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
    <div class="ih-item square effect11 left_to_right">
        <a href="/">
            <div class="img">
                <h3>1111<?= $model->title ?></h3>
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


    <div class="ih-item square effect8 scale_dowm">
        <a href="/">
            <div class="img">
                <h3>888<?= $model->title ?></h3>
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
    <div class="ih-item square effect7 ">
        <a href="/">
            <div class="img">
                <h3>777<?= $model->title ?></h3>
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
    <div class="ih-item square effect6 from_top_and_bottom">
        <a href="/">
            <div class="img">
                <h3>666<?= $model->title ?></h3>
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
    <div class="ih-item square effect5 left_to_right">
        <a href="/">
            <div class="img">
                <h3>555<?= $model->title ?></h3>
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

    <div class="ih-item square effect2 ">
        <a href="/">
            <div class="img">
                <h3>222<?= $model->title ?></h3>
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





</div>

