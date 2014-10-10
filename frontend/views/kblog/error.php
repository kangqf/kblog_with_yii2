<?php
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
      <p> 出现错误了。。。。。。。。。 </p>
        <?= nl2br(Html::encode($message))
        //nl2br() 函数在字符串中的每个新行 (\n) 之前插入 HTML 换行符 ()?>
    </div>

    <p>
        当服务器处理你的请求的时候，出现了一个<?= $exception->statusCode ?>的错误！
    </p>
    <p>
        如果你认为这是服务器的错误，请联系我们，谢谢！
    </p>

</div>
