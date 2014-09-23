<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-9-23
 * Time: 下午3:58
 */


/**
 * @var yii\web\View $this
 * @var app\models\Item $model
 */
?>
<div style="height: auto; text-align: center;">
    <div class="title"><?= $model->created_time ?></div>
    <div class="title"><?= $model->updated_time ?></div>
    <div class="title"><?= $model->author_id ?></div>

</div>
<div class="title"><?= $model->content ?></div>