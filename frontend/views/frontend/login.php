<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

use kartik\form\ActiveForm;
use yii\helpers\Html;

/** @var common\models\LoginForm  $loginModel */

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="kblog-login col-xs-10 col-xs-offset-1 col-sm-8
col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

    <?php
    //水平表单
    $form = ActiveForm::begin([
        //  'type'=>ActiveForm::TYPE_VERTICAL,
        //  'formConfig'=>['deviceSize'=>ActiveForm::SIZE_SMALL],
    ]);
    ?>
    <div class="form-group ">
        <?=
        $form->field($loginModel, 'email',
            ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-envelope"></i>']],
                'showLabels' => false])->textInput(['placeholder' => '请输入邮箱']);
        ?>

        <?=
        $form->field($loginModel, 'password',
            ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-lock"></i>']],
                'showLabels' => false])->passwordInput(['placeholder' => '请输入密码']);
        ?>
        <span style="float:left; margin-top:-10px">
          <?= $form->field($loginModel, 'rememberMe')->checkbox() ?>
      </span>
      <span style="float:right; margin-top:0px; margin-left:30px">
        <?= Html::a('找回密码', ['kblog/request-password-reset']) ?>
      </span>
        <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block']) ?>
        <div class="authclient">
            <?php //yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['kblog/auth']]); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<style media="screen" type="text/css">


    @media (min-width: 768px) {

        .kblog-login {
            margin-top: 100px;
            margin-bottom: 100px;
        }

        .authclient {
            margin-top: 30px;
        }
    }

    @media (max-width: 768px) {

        .kblog-login {
            margin-top: 10px;
            margin-bottom: -25px;
        }

        .authclient {
            margin-top: 30px;
        }

    }


</style>