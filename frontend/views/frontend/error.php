<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
use yii\helpers\Html;
$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <h2>
       出现问题了 :(
    </h2>
    <h3>
       快联系<a href="mailto:kangqingfei@gmail.com"> 开发者 </a>赢取千元好礼！
    </h3>

</div>