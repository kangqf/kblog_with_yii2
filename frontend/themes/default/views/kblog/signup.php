<?php
use yii\helpers\Html;

/**
 * 注册页面
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var frontend\modules\user\models\SignupForm $model
 */
$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <br/>
    <?= $this->render('public/_info', ['model' => $model]); ?>
    
</div>
