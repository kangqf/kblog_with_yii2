<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DefaultLayoutAsset;

DefaultLayoutAsset::register($this);

$this->title = "kblog";
// Yii::$app->urlManager->setBaseUrl('..\.\backend\web');
//echo Yii::$app->urlManager->getBaseUrl();
// var_dump();
 //die();

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
  </head>

  <body>
    <?php $this->beginBody() ?>
    <div class="wrap">
      <?php
          NavBar::begin
          ([
              'brandLabel' => Yii::$app->name,
              //'brandUrl' => Yii::$app->urlManagerBackend->createAbsoluteUrl(['/site/login']),
              'brandOptions' => ['id'=>'brand'],
              'options' => ['class' => 'navbar-inverse','id'=>'navbar' ],
          ]);

          $menuItems =
          [
              ['label' => 'Home', 'url' => ['/kblog/index']],
              ['label' => 'About', 'url' => ['/kblog/about']],
              ['label' => 'Test1', 'url' => ['/kblog/test1']],
              ['label' => 'Test', 'url' => ['/kblog/test']],
          ];

          if (Yii::$app->user->isGuest)
          {
              $menuItems[] = ['label' => '登录', 'url' => ['/kblog/info'] ];
          }
          else
          {
              $menuItems[] =
              [
                  'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                  'url' => ['/kblog/logout'],
                  'linkOptions' => ['data-method' => 'post']
              ];
          }

          echo Nav::widget
          ([
              'options' => ['class' => 'navbar-nav navbar-right'],
              'items' => $menuItems,
          ]);

          NavBar::end();
      ?>

      <div class="container">
        <?=
          Breadcrumbs::widget
          ([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              'homeLink' => ['label' => '<span class="glyphicon glyphicon-home"></span>', 'url' => Html::a('首页',Yii::$app->homeUrl)],
          ])
        ?>
      </div>

      <div id="content" class="container">
        <?= $content ?>
      </div>

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
