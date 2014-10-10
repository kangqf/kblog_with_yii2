<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['kblog/reset-password', 'token' => $user->password_reset_token]);
?>

您好 <?= Html::encode($user->username) ?>,

点击下面的链接重置你的密码:

<?= Html::a(Html::encode($resetLink), $resetLink) ?>
