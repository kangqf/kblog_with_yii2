<?php

use common\models\User;
use frontend\assets\ArticleAsset;
use yii\helpers\Html;
use common\models\Category;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Modal;
use common\models\Comment;
use kartik\w;

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
            <div id="comment-brand" style="display: inline-table">

                <span class="glyphicon glyphicon-edit"></span>
                <?= $model->comment_count ?>
            </div>
            <div id="click-brand" style="display: inline-table">

                <span class="glyphicon glyphicon-heart"></span>
                <?= $model->zan ?>
            </div>
            <div id="click-brand" style="display: inline-table">

                <span class="glyphicon glyphicon-hand-up"></span>
                <?= $model->click_count ?>
            </div>
            <div id="time-brand" style="display: inline-table">

                <span class="glyphicon glyphicon-time"></span>
                <?=  date("Y-m-d H:i",$model->updated_time) ?>
            </div>
        </div>

        <div id="content" class="">
            <?= $model->content ?>
        </div>

    </div>

    <div class="col-md-10 col-md-offset-2" id="write_comment">
        <?php
        $form = ActiveForm::begin();?>
        <input type="hidden" name="CommentForm[aid]" value= <?= $model->aid ?>/>
        <?php
        echo $form->field($comment, 'message')->widget(
            MarkdownEditor::classname(),
            ['height' => 300, 'encodeLabels' => false]
        );

        echo Html::submitButton('评论', ['class' => 'btn btn-primary btn-block']);

        ActiveForm::end();

        ?>

        <!--    <button type="submit" id="comment_btn" class="btn btn-primary btn-block">评论</button>-->
    </div>

    <?php
    Modal::begin(['id' => 'comment-success', 'header' => '<h2>提示</h2>', //  'toggleButton' => ['label' => 'click me'],
    ]);
    echo '评论成功';
    Modal::end();
    ?>
    <div id="comment">
        <?php

        $allComment = Comment::getCommentByArticleId($model->aid);


        foreach ($allComment as $key => $value) {
            ?>
            <div class="comment-item">

                <?= $value->message ?>

            </div>

        <?php

        }

        ?>
    </div>


</div>





<?php
$script = <<< JS
    $('#comment_btn').on('click', function() {
        console.log('btn click');
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var comment = $('#comment_content').val();
        $.ajax({
            url: '/article/comment',
            type: 'post',
            dataType: 'json',
            data: {'comment': comment,  _csrf : csrfToken},
            success: function(data) {
            console.log('btn responce');
            console.log(data);
            document.getElementById('comment_content').innerHTML = data.comment;
            }
        });
    });
JS;
//   $this->registerJs($script, $this::POS_END);


//        echo MarkdownEditor::widget([
//            'id' => 'comment_content',
//            'name' => 'comment',
//            'value' => '填写评论',
//        ]);

?>