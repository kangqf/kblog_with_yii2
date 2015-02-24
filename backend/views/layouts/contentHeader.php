<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

use yii\widgets\Breadcrumbs;

?>

<section class="content-header">
    <h1>
        <?php
        if ($this->title !== null) {
            echo $this->title;
        } else {
            echo \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id));
            echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
        } ?>
    </h1>
    <?=
    Breadcrumbs::widget
    ([
        'encodeLabels' => false,
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'homeLink' => ['label' => '<span class="glyphicon glyphicon-home"></span>', 'url' => Yii::$app->homeUrl],
    ])
    ?>
</section>