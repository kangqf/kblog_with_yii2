<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="kblog-login col-xs-10 col-xs-offset-1 col-sm-8
col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

<?php   //水平
  $form = ActiveForm::begin([
    'type'=>ActiveForm::TYPE_VERTICAL,
    'formConfig'=>['deviceSize'=>ActiveForm::SIZE_SMALL],
  ]);
?>
  <div class="form-group ">
      <?= $form->field($model, 'username',
        ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>'] ],
        'showLabels'=>false])->textInput(['placeholder'=>'用户名']);
      ?>

      <?= $form->field($model, 'password',
        ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-lock"></i>'] ],
        'showLabels'=>false])->passwordInput(['placeholder'=>'密码']);
      ?>
        <div style="checkbox-inline">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Html::a('找回密码', ['site/request-password-reset']) ?>
        </div>
      <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block']) ?>
      <div class="authclient">
      <?= yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['kblog/auth']]); ?>
      </div>
  </div>

<?php ActiveForm::end(); ?>
</div>

<style media="screen" type="text/css">
  .kblog-login{
    margin-top:100px;
    margin-bottom:100px;
  }
  .authclient{
    margin-top:30px;
  }


</style>
