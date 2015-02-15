<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
use yii\helpers\Html;

/* @var $caption string */
/* @var $values array */
?>

    <h3><?= $caption ?></h3>

<?php if (empty($values)): ?>

    <p>Empty.</p>

<?php else: ?>

    <table class="table table-condensed table-responsive table-striped table-hover" style="table-layout: fixed;">
        <thead>
        <tr>
            <th style="width: 200px;">名称</th>
            <th>值</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($values as $name => $value): ?>
            <tr>
                <th style="width: 200px;"><?= Html::encode($name) ?></th>
                <td style="overflow:auto"><?= Html::encode($value) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>