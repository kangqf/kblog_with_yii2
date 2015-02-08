<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

/**
 * 前台默认布局文件
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

use frontend\assets\FrontendLayoutAsset;

/* @var $this \yii\web\View */
/* @var $content string */

FrontendLayoutAsset::register($this);
$this->title = "kblog";
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head(); ?>
    </head>

    <body>
    <?php $this->beginBody() ?>
        <?php
            NavBar::begin(['brandLabel' => 'NavBar Test']);

                echo Nav::widget([
                    'items' => [
                       ['label' => 'Home', 'url' => ['/site/index']],
                       ['label' => 'About', 'url' => ['/site/about']],
                    ],
                ]);

            NavBar::end();
        ?>
        <!-- 导航栏 -->
        <div class="container" id="breadCrumbs">
            <?=
            Breadcrumbs::widget
            ([
                'encodeLabels' => false,//对Html 源文件中不允许出现的字符进行编码
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'homeLink' => ['label' => '<span class="glyphicon glyphicon-home"></span>', 'url' => Yii::$app->homeUrl],
            ])
            ?>
        </div>
        <!--    页面主体内容    -->
        <div id="content" class="container">
            <?= $content ?>
        </div>
        <!-- 页脚 -->
        <footer class="footer" id="footer">
            <div class="container">
                Copyright &copy; <?= date('Y') ?> by My CQUPT.<br/>
                All Rights Reserved.<br/>
                <?= Yii::powered() ?>
            </div>
        </footer>
    <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
