<?php

use yii\helpers\Html;
//use common\models\SignupForm;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$signupModel = new SignupForm;
?>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
