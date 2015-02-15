<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

use backend\models\LeftSideMenu;
use backend\assets\BackendLayoutAsset;
use backend\assets\AdminLteAsset;
use backend\assets\IoniconsAssets;
use backend\assets\FontAwesomeAssets;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
AdminLteAsset::register($this);
//IoniconsAssets::register($this);
FontAwesomeAssets::register($this);
BackendLayoutAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="skin-black">
    <?php $this->beginBody() ?>

        <!-- header logo: style can be found in header.less -->
        <?php $this->beginContent('@backend/views/layouts/header.php'); ?>
        <?php $this->endContent(); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar -->
            <?php
                $leftSideMenu = new LeftSideMenu();
                $this->beginContent('@backend/views/layouts/leftside.php',['leftSideMenu' => $leftSideMenu->getLeftSideMenu()]);
            ?>
            <?php $this->endContent(); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <?php $this->beginContent('@backend/views/layouts/contentHeader.php'); ?>
                <?php $this->endContent(); ?>

                <!-- Main content -->
                <?php
                    //使用contents来作为键传递变量，而不是content
                    $this->beginContent('@backend/views/layouts/content.php',['contents' => $content]);
                ?>
                <?php $this->endContent(); ?>
                <?php //$content ?>
                <!-- /.content -->
                <footer class="footer" id="footer">
                    <div class="container">
                        Copyright &copy; <?= date('Y') ?> by My CQUPT.<br/>
                        All Rights Reserved.<br/>
                        <?= Yii::powered() ?>
                    </div>
                </footer>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

    <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
