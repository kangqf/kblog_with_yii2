<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\fileInput;

/**
 * Представление страницы регистрации нового пользователя
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var frontend\modules\user\models\SignupForm $model
 */
$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写下面的字段，以注册</p>

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin([
              'id' => 'form-signup' ,
              'options'=>['enctype'=>'multipart/form-data']
              ]); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <br/><br/><br/><br/>


                <?php
                echo $form->field($model,'avatar')->widget(
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
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  '更换头像',
                        'initialPreview' => [
                          Html::img( Yii::$app->homeUrl.'Desert.jpg', ['class' =>'file-preview-image',
                            'alt' => '没找到默认头像', 'title' => '默认头像']),
                        ],

                      ],
                    ]
                )
                ?>

                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
