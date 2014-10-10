<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-9-23
 * Time: 下午3:58
 */

use common\models\User;
use common\models\Category;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$khover = [
    0=> 'effect15 bottom_to_top',
    1=> 'effect14 right_to_left',
    2=> 'effect13 right_to_left',
    3=> 'effect12 top_to_bottom',
    4=> 'effect11 left_to_right',
    5=> 'effect8 scale_dowm',
    6=> 'effect7',
    7=> 'effect6 from_top_and_bottom',
    8=> 'effect5 left_to_right',
    9=> 'effect2',
];

//  Html::img( Yii::$app->homeUrl . 'image/1.jpg' ,['class' => 'file-preview-image', 'alt' => '没找到默认头像', 'title' => '默认头像']);

/**
 * @var yii\web\View $this
 * @var app\models\Item $model
 */
?>

<div class="col-md-6">
    <div class="ih-item square <?= $khover[$model->aid%10]; ?>">
        <a href=" <?=Yii::$app->urlManager->createUrl(['article','id' => $model->aid])?>">
            <div class="origin">
                <h3><?= $model->title ?>
                    <div style=" display: inline-table; float:right;">
                        <?= User::getAvatarById($model->author_id); ?>
                    </div>
                </h3>
                <p><?php  echo $model->summary; ?></p>
            </div>
            <div class="info">
                <h3>作者：<?= User::getNameById($model->author_id) ?> 分类：<?= Category::getNameById($model->category_id) ?></h3>
                <p>
                    点击：<?= $model->click_count ?> &nbsp;&nbsp;&nbsp;
                    评论：<?= $model->comment_count ?> &nbsp;&nbsp;&nbsp;
                    时间：<?= date("Y-m-d H:i",$model->updated_time); ?>
                </p>
            </div>
        </a>
    </div>


</div>

