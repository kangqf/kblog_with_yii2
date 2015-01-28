<?php
/**
 * @link http://kangqingfei.com/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

/**
 * 前台默认布局文件
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */

use yii\helpers\Html;
use frontend\assets\FrontendLayoutAsset;

FrontendLayoutAsset::register($this);
$this->title = "KBlog";
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
        <div class="wrap">
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
