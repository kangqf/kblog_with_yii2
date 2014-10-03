<?php

use common\models\User;
use frontend\assets\ArticleAsset;
use yii\helpers\Html;
use common\models\Category;

ArticleAsset::register($this);
?>

<div class="">

   <div class="col-md-2 " id="author_info">
       <div id="author_avatar_div" >
           <?= User::getAvatarById($model->author_id,80,['id' => 'author_avatar']); ?>
       </div>
       <div id="author_name_div" >
           <?= User::getNameById($model->author_id)?>
       </div>
       <div id="author_email_div" >
            <?= html::a(User::getEmailById($model->author_id)) ?>
       </div>
   </div>

    <div class="col-md-10 " id="article_info">
        <div id="title">
            <h2>
                <?= $model->title ?>
            </h2>
        </div>

        <div id="one-line-info">
            <div id="category" style="display:inline-table">

                <span class="glyphicon glyphicon-briefcase"></span>
                <?= Category::getNameById($model->category_id) ?>
            </div>
            <div class="comment" style="display: inline-table">

                <span class="glyphicon glyphicon-edit"></span>
                <?= $model->comment_count ?>
            </div>
            <div class="click"style="display: inline-table">

                <span class="glyphicon glyphicon-heart"></span>
                <?= $model->zan ?>
            </div>
            <div class="click"style="display: inline-table">

                <span class="glyphicon glyphicon-hand-up"></span>
                <?= $model->click_count ?>
            </div>
            <div class="time"style="display: inline-table">

                <span class="glyphicon glyphicon-time"></span>
                <?=  date("Y-m-d H:i",$model->updated_time) ?>
            </div>
        </div>

        <div id="content" class="">
            <?= $model->content ?>
        </div>

    </div>

    <div class="col-md-10" id="write_comment">


    </div>



</div>