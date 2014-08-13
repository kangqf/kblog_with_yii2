<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form ActiveForm */



  //yii\authclient\widgets\AuthChoice::widget([ 'baseAuthUrl' => ['kblog/auth']]);
?>

<?php
  use yii\authclient\widgets\AuthChoice;
?>
  <?php $authAuthChoice = AuthChoice::begin([
      'baseAuthUrl' => ['kblog/auth']
  ]); ?>
  <ul>
  <?php foreach ($authAuthChoice->getClients() as $client): ?>
      <li><?= $authAuthChoice->clientLink($client) ?></li>
  <?php endforeach; ?>
  </ul>
  <?php AuthChoice::end(); ?>


<div class="kblog-login">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'login_count') ?>
        <?= $form->field($model, 'last_user_login_id') ?>
        <?= $form->field($model, 'creat_time') ?>
        <?= $form->field($model, 'type_id') ?>
        <?= $form->field($model, 'staus') ?>
        <?= $form->field($model, 'open_id') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'avatar') ?>
        <?= $form->field($model, 'level') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- kblog-login -->
