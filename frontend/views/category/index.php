<?php
/**
 * @var yii\web\View $this
 */

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => 'public/_item',
    'pager' => [
        'class' => \kop\y2sp\ScrollPager::className(),
        'negativeMargin' => 500,
        'noneLeftText' => '没有更多内容',
        'triggerText' => '加载更多',

    ],

    'summary' => '',
]);
?>
