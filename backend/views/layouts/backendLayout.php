<?php

use backend\assets\BackendLayoutAsset;
use backend\assets\AdminLteAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
BackendLayoutAsset::register($this);
AdminLteAsset::register($this);

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
        <!-- bootstrap 3.2.0
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Font Awesome Icons
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Ionicons
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Theme style
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />-->
    </head>
    <body class="skin-blue">
    <?php $this->beginBody() ?>
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <?php $this->beginContent('@backend/views/layouts/header.php'); ?>
        header
        <?php $this->endContent(); ?>
    <header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <?php $this->beginContent('@backend/views/layouts/header.php'); ?>
            left-side
            <?php $this->endContent(); ?>

        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php $this->beginContent('@backend/views/layouts/header.php'); ?>
                right-side-content-header
                <?php $this->endContent(); ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php $this->beginContent('@backend/views/layouts/header.php'); ?>
                right-side-content
                <?php $this->endContent(); ?>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->


    <!-- jQuery 2.0.2
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
    <!-- Bootstrap
    <script src="js/plugins/bootstrap.min.js" type="text/javascript"></script>-->
    <!-- AdminLTE App
    <script src="js/plugins/AdminLTE/app.js" type="text/javascript"></script>-->
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
