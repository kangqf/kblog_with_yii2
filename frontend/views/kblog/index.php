<?php
//use frontend\assets\DefaultLayoutAsset;
//defaultLayoutAsset::register($this);
use yii\widgets\ListView;

?>
<?php
//$this->beginPage()
?>
<?php
//$this->head();
?>

<?php
//$this->beginBody()
?>


<div style="margin-top: 0px;margin-bottom:  0px">

    <!-- Yii::$app->session->getFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.'); -->
    <?php
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


</div>

<?php
//$this->endBody()
?>
<?php
//$this->endPage()
?>
