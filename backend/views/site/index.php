<?php
/* @var $this yii\web\View */

use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">


        <?php
        // echo Nav::widget([ 'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)]);
        ?>


    </div>
</div>
