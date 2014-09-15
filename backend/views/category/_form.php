<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'level'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Level...']], 

'status'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter status...']], 

'visual_able'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Visual Able...']], 

'parent_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Parent ID...']], 

'name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Name...', 'maxlength'=>30]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
