<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;

?>
<div class="container-fluid">
    <div class="row">
        <?php $form = ActiveForm::begin([
            'id' => 'form-register' ,
            'options'=>['enctype'=>'multipart/form-data']
        ]); ?>

        <div class="col-md-3 col-md-offset-1">
            <?= $form->field($model,'avatar')->widget(
                FileInput::classname(),
                [
                    'options'=> ['accept' => 'image/*'],
                    'showMessage' => true,
                    'pluginOptions' => [
                        'previewFileType' => 'image',
                        'showCaption' => false,
                        'showUpload' => false,
                        'showRemove' => false,
                        'browseClass' => 'btn btn-primary btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-picture"></i> ',
                        'browseLabel' =>  '更换头像',
                        'initialPreview' => [
                          //  Html::img($model['avatar'] ? Yii::$app->homeUrl . 'avatar/' . $model['avatar'] : Yii::$app->homeUrl . 'default.png', ['class' => 'file-preview-image',
                           //     'alt' => '没找到默认头像', 'title' => '默认头像']),
                        ],

                    ],
                ]
            );
            ?>
        </div>

        <div class="col-md-4 col-md-offset-1">
            <br/>
            <?= $form->field($model, 'username',

                [
                    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>'] ],
                    'showLabels'=>false,
                    'enableAjaxValidation' => true,
                ])->textInput(['placeholder'=>'请输入用户名']);
            ?>
            <br/>

            <?= $form->field($model, 'email',
                [
                    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-envelope"></i>'] ],
                    'showLabels'=>false,
                    'enableAjaxValidation' => true,
                ])->textInput(['placeholder'=>'请输入邮箱']);
            ?>
            <br/>

            <?= $form->field($model, 'password',
                ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-lock"></i>'] ],
                    'showLabels'=>false])->passwordInput(['placeholder'=>'请输入密码']);
            ?>
            <br/>
            <?php
            echo $form->field($model, 'checkPassword',
                ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-lock"></i>'] ],
                    'showLabels'=>false])->passwordInput(['placeholder'=>'请确认密码']);
            ?>
        </div>

    </div>

    <div class="col-md-offset-5 col-md-2">

        <?=
//        Html::submitButton($model->isNewRecord ? '注册' : '更新', [
//                'class'=>$model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block',
//                'name' => 'signup-button'
//            ]
//        );
        Html::submitButton('注册', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<div style="height:50px">

</div>