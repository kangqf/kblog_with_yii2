<?php 

use yii\helpers\Html;

 ?>

<?php $this->beginPage() ?>

<?php $this->head(); ?>

<?php $this->beginBody() ?>


<?php
//ActiveForm
use kartik\widgets\ActiveForm;

?>

<?php   //竖直
  $form = ActiveForm::begin([ 'type'=>ActiveForm::TYPE_HORIZONTAL,'formConfig'=>['labelSpan'=>3, 'deviceSize'=>ActiveForm::SIZE_SMALL], ]);
?>
<div class="form-group kv-fieldset-inline">
    
    <?= Html::activeLabel($model, 'modelattrbute', ['label'=>'Operation Dates', 'class'=>'col-sm-2 control-label']); ?>
    <div class="col-sm-2">
      <?= $form->field($model, 'name',['showLabels'=>false])->textInput(['placeholder'=>'From Date']); ?>
    </div>
    <div class="col-sm-2">
      <?= $form->field($model, 'name',['showLabels'=>false])->textInput(['placeholder'=>'To Date']); ?>
    </div>
      <?= Html::activeLabel($model, 'name', ['label'=>'Experiment Dates', 'class'=>'col-sm-2 control-label']) ?>
    <div class="col-sm-2">
      <?= $form->field($model, 'name',['showLabels'=>false])->textInput(['placeholder'=>'Begin Date']); ?>
    </div>
    <div class="col-sm-2">
      <?= $form->field($model, 'name',['showLabels'=>false])->textInput(['placeholder'=>'End Date']); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php //水平
  $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL,]);
?>
<?php ActiveForm::end(); ?>

<?php   // Inline Form
  $form = ActiveForm::begin(['id' => 'form-login','type' => ActiveForm::TYPE_INLINE,'fieldConfig' => ['autoPlaceholder'=>true]]);
?>
<?php ActiveForm::end(); ?>

<form  class="form-horizontal" action="" method="post">
  <div class="form-group">

    <label  class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputSuccess4" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
</form>



<?php   //竖直
  $form = ActiveForm::begin();
?>

<?php

echo $form->field($model, 'name', ['addon' => ['prepend' => ['content'=>'@'] ] ]);

echo $form->field($model, 'name', ['addon' => ['append' => ['content'=>'.00']],]);

echo $form->field($model, 'name', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>'] ] ]);

echo $form->field($model, 'name', ['addon' => ['prepend' => ['content'=>'<input type="checkbox">'] ] ]);

echo $form->field($model, 'name', [
    'addon' => [
        'append' => [
            'content' => Html::button('Go', ['class'=>'btn btn-primary']), 
            'asButton' => true
        ]
    ]
]);

echo $form->field($model, 'name', [
    'addon' => [
        'append' => [
            'content' => \yii\bootstrap\ButtonDropdown::widget([
                'label' => 'Action',
                'dropdown' => [
                    'items' => [
                        ['label' => 'Another action', 'url' => '#'],
                        ['label' => 'Something else', 'url' => '#'],
                        '<li class="divider"></li>',
                        ['label' => 'Separated link', 'url' => '#'],
                    ],
                ],
                'options' => ['class'=>'btn-default']
            ]),
            'asButton' => true
        ]
    ]
]);
?>

<?php ActiveForm::end(); ?>




<?php
use kartik\widgets\SideNav;
 echo SideNav::widget([
     'items' => [
          [
              'url' => ['/kblog/index'],
              'label' => 'SideNav',
              'icon' => 'home'
          ],
          [
              'url' => ['/kblog/about'],
              'label' => 'About',
              'icon' => 'info-sign',
              'items' => [
                   ['url' => '/kblog/about', 'label' => 'Go to about'],
                   ['url' => '#', 'label' => 'Item 2'],
              ],
          ],
      ],
  ]);

?>

<?php

use yii\bootstrap\Alert;

Alert::begin([
      'options' => [
          'class' => 'alert-warning',
      ],
  ]);
 
  echo 'Say hello...';
 
  Alert::end();

?>

<?php $this->endBody() ?>

<?php $this->endPage() ?>

