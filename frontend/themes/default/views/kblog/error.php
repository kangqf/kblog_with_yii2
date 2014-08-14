<?php
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
      <p> 出现错误了。。。。。。。。。 </p>
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        当服务器处理你的请求的时候，出现了一个不明的错误！
    </p>
    <p>
        请联系我们如果你认为这是服务器的错误，谢谢！
    </p>

</div>
