<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'author_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Author ID...']], 

'category_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Category ID...']], 

'comment_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Comment ID...']], 

'set_index'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Set Index...']], 

'set_top'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Set Top...']], 

'set_recommend'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Set Recommend...']], 

'click_count'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Click Count...']], 

'status'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Status...']], 

'creat_time'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Creat Time...']], 

'update_time'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Update Time...']], 

'content'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter 这会是内容...','rows'=> 6]], 

'tags'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Tags...','rows'=> 6]], 

'keywords'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Keywords...','rows'=> 6]], 

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Title...', 'maxlength'=>50]], 

'summary'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Summary...', 'maxlength'=>300]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
