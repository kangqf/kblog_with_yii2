<?php

use backend\assets\BackendLayoutAsset;
use backend\assets\AdminLteAsset;
use backend\assets\IoniconsAssets;
use backend\assets\FontAwesomeAssets;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
BackendLayoutAsset::register($this);
AdminLteAsset::register($this);
IoniconsAssets::register($this);
FontAwesomeAssets::register($this);

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
            <?php $this->beginContent('@backend/views/layouts/leftside.php'); ?>
            <?php $this->endContent(); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <?php $this->beginContent('@backend/views/layouts/contentHeader.php'); ?>
                <?php $this->endContent(); ?>

                <!-- Main content -->
                <?php $this->beginContent('@backend/views/layouts/content.php'); ?>
                <?php $this->endContent(); ?>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

    <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
