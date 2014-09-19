<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

use common\models\User;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form col-lg-6 col-lg-offset-3">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

      //      'uid'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 用户ID...']],

            'username'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 用户名...', 'maxlength'=>30]],

            'email'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 邮箱...', 'maxlength'=>50]],

            'password'=>['type'=> Form::INPUT_PASSWORD, 'options'=>['placeholder'=>'Enter 密码...', 'maxlength'=>64]],

        //    'avatar'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 头像...', 'maxlength'=>255]],

        //    'created_time'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 创建时间...']],

        //    'updated_time'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 上次登录时间...']],

       //     'login_count'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 登陆次数...']],

            'status'=>['type'=> Form::INPUT_DROPDOWN_LIST,'items' => User::getStatusArray(), 'options'=>['placeholder'=>'Enter 状态...']],

            'role'=>['type'=> Form::INPUT_DROPDOWN_LIST,'items' => User::getRoleArray(), 'options'=>['placeholder'=>'Enter 级别...']],

        //    'open_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 第三方ID...', 'maxlength'=>100]],

         //   'auth_key'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 授权密钥...', 'maxlength'=>32]],

         //   'password_hash'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 哈希密码...', 'maxlength'=>255]],

         //   'password_reset_token'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 重设访问令牌...', 'maxlength'=>255]],

        ]

        ]);
    //dump( get_parent_class($model));die();
    echo Html::submitButton($model instanceof yii\base\Model ? 'Create' : 'Update', ['id'=>'btn-cu','class' => $model instanceof yii\base\Model ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
<style>
#btn-cu{
    float: right;
}

</style>
