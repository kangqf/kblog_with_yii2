<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

?>


<div style = "height:100px">

</div>
<?php   //水平
  $form = ActiveForm::begin([
    'type'=>ActiveForm::TYPE_VERTICAL,
    'formConfig'=>['labelSpan'=>3, 'deviceSize'=>ActiveForm::SIZE_SMALL],
  ]);
?>
<div class="form-group col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-3">
    <?= $form->field($model, 'name',
      ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>'] ],
      'showLabels'=>false])->textInput(['placeholder'=>'用户名']);
    ?>

    <?= $form->field($model, 'password',
      ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-lock"></i>'] ],
      'showLabels'=>false])->passwordInput(['placeholder'=>'密码']);
    ?>

    <div class="form-group">
        <?= Html::submitButton('登录', ['class' => 'btn btn-primary']) ?>
    <?= yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['kblog/auth']]); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>



<div class="kblog-login ">


</div>
