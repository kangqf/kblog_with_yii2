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

/*$toolBar = [
                [
                    'buttons' => [
                        MarkdownEditor::BTN_BOLD => ['icon' => 'bold', 'title' => Yii::t('markdown', 'Bold')],
                        MarkdownEditor::BTN_ITALIC => ['icon' => 'italic', 'title' => Yii::t('markdown', 'Italic')],
                        MarkdownEditor::BTN_PARAGRAPH => ['icon' => 'font', 'title' => Yii::t('markdown', 'Paragraph')],
                        MarkdownEditor::BTN_NEW_LINE => ['icon' => 'text-height', 'title' => Yii::t('markdown', 'Append Line Break')],
                        MarkdownEditor::BTN_HEADING => ['icon' => 'header', 'title' => Yii::t('markdown', 'Heading'), 'items' => [
                                MarkdownEditor::BTN_H1 => $heading(1),
                                MarkdownEditor::BTN_H2 => $heading(2),
                                MarkdownEditor::BTN_H3 => $heading(3),
                                MarkdownEditor::BTN_H4 => $heading(4),
                                MarkdownEditor::BTN_H5 => $heading(5),
                                MarkdownEditor::BTN_H6 => $heading(6),
                            ]
                        ],
                    ],
                ],

                [
                    'buttons' => [
                        MarkdownEditor::BTN_LINK => ['icon' => 'link', 'title' => Yii::t('markdown', 'URL/Link')],
                        MarkdownEditor::BTN_IMAGE => ['icon' => 'picture', 'title' => Yii::t('markdown', 'Image')],
                    ],
                ],

                [
                    'buttons' => [
                        MarkdownEditor::BTN_INDENT_L => ['icon' => 'indent-left', 'title' => Yii::t('markdown', 'Indent Text')],
                        MarkdownEditor::BTN_INDENT_R => ['icon' => 'indent-right', 'title' => Yii::t('markdown', 'Unindent Text')],
                    ],
                ],

                [
                    'buttons' => [
                        MarkdownEditor::BTN_UL => ['icon' => 'list', 'title' => Yii::t('markdown', 'Bulleted List')],
                        MarkdownEditor::BTN_OL => ['icon' => 'list-alt', 'title' => Yii::t('markdown', 'Numbered List')],
                        MarkdownEditor::BTN_DL => ['icon' => 'th-list', 'title' => Yii::t('markdown', 'Definition List')],
                    ],
                ],

                [
                    'buttons' => [
                        MarkdownEditor::BTN_FOOTNOTE => ['icon' => 'edit', 'title' => Yii::t('markdown', 'Footnote')],
                        MarkdownEditor::BTN_QUOTE => ['icon' => 'comment', 'title' => Yii::t('markdown', 'Block Quote')],
                    ],
                ],

                [
                    'buttons' => [
                        MarkdownEditor::BTN_CODE => ['label' => MarkdownEditor::ICON_CODE, 'title' => Yii::t('markdown', 'Inline Code'), 'encodeLabel' => false],
                        MarkdownEditor::BTN_CODE_BLOCK => ['icon' => 'sound-stereo', 'title' => Yii::t('markdown', 'Code Block')],
                    ],
                ],

                [
                    'buttons' => [
                        MarkdownEditor::BTN_HR => ['label' => MarkdownEditor::ICON_HR, 'title' => Yii::t('markdown', 'Horizontal Line'), 'encodeLabel' => false],
                    ],
                ],

                [
                    'buttons' => [
                        MarkdownEditor::BTN_MAXIMIZE => ['icon' => 'fullscreen', 'title' => Yii::t('markdown', 'Toggle full screen'), 'data-enabled' => true]
                    ],
                    'options' => ['class' => 'pull-right']
                ],
        ]*/



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
        <input type="hidden" name="CommentForm[aid]" value= <?= $model->aid ?> />
        <?php
        echo $form->field($comment, 'message',
        [  'showLabels' => false,'enableClientValidation'=>false,])->widget(
            MarkdownEditor::classname(),

            ['height' => 80, 'encodeLabels' => false,
               // 'toolbar' => $toolBar
                'footerMessage' => '尽情使用MarkDown语法',
            ]
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

            <div class="comment-item col-md-12">
                <div class="commenter-avatar">
                    <?= User::getAvatarById($value->user_id,80,[]); ?>
                </div>
                <div class="comment-content">
                    <?= $value->message ?>
                </div>



            </div>

        <?php    }  ?>

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