<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\TabularForm;
use kartik\datecontrol\DateControl;
use common\models\Article;
use common\models\Category;
/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="article-form">

    <?php

    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]);



    echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 3,
    'attributes' => [

      //  'author_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Author ID...']],

        'category_id'=>['type'=> Form::INPUT_DROPDOWN_LIST,'items' => Category::getAllCategoryArray(), 'options'=>['placeholder'=>'Enter Category ID...']],

       // 'category_id'=>['type'=> TabularForm::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Comment ID...']],

        'set_index'=>['type'=> Form::INPUT_DROPDOWN_LIST,'items' => Article::getYNArray(), 'options'=>['placeholder'=>'Enter Set Index...']],

        'set_top'=>['type'=> Form::INPUT_DROPDOWN_LIST,'items' => Article::getYNArray(), 'options'=>['placeholder'=>'Enter Set Top...']],

        'set_recommend'=>['type'=> Form::INPUT_DROPDOWN_LIST,'items' => Article::getYNArray(), 'options'=>['placeholder'=>'Enter Set Recommend...']],

      //  'click_count'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Click Count...']],

      //  'status'=>['type'=> Form::INPUT_DROPDOWN_LIST,'items' => Article::getStatusArray(), 'options'=>['placeholder'=>'Enter Status...']],

     //   'created_time'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Creat Time...']],

    //    'updated_time'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Update Time...']],
        'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Title...', 'maxlength'=>50]],

       // 'content'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['style'=>'margin:-10,-10;','placeholder'=>'Enter 这会是内容...','rows'=> 6]],



       // 'tags'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Tags...','rows'=> 6]],

       // 'keywords'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Keywords...','rows'=> 6]],



        'summary'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Summary...', 'maxlength'=>300]],

    ]
    ]);

  ?>


    <div class="col-md-10 col-md-offset-1">
        <textarea id="article-content" class="col-md-12" name="Article[content]" rows="16">

        </textarea>
    </div>

    <div id="ueditor">
    <?php

   // echo $form->field($model, 'content')->textarea(['rows' => 16],['options' => ['class' => 'col-md-12']]);


    echo \xj\ueditor\Ueditor::widget([
        'model' => $model,
        'attribute' => 'content',
       // 'name' => 'customName',
       // 'value' => 'content',
        'style' => 'width:100%;height:400px',
        'renderTag' => false,
        'readyEvent' => 'console.log("example2 ready")',
        'jsOptions' => [
            'serverUrl' => yii\helpers\Url::to(['upload']),
            'autoHeightEnable' => true,
            'autoFloatEnable' => true
        ],
    ]);
?>
    </div>


    <?php
    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id'=>'article-submit','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
<style>
#article-content{
    height:450px;
    width: 100%;
}
    #article-submit{
        float: right;
        margin-top:600px;
    }
</style>
