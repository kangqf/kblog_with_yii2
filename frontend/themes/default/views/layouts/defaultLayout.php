<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DefaultLayoutAsset;
use kartik\widgets\ActiveForm;
use frontend\models\ContactForm;
use common\models\User;

DefaultLayoutAsset::register($this);

$this->title = "KBlog";

$model = new User();

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
              'brandUrl' => Yii::$app->urlManagerBackend->createUrl(['/site/login']),
              'brandOptions' => ['id'=>'brand','class'=>'pull-right',],
              'options' => ['class' => 'navbar-inverse','id'=>'navbar' ],
          ]);
          $menuItems =
          [
              ['label' => 'Home', 'url' => ['/kblog/index']],
              ['label' => 'About', 'url' => ['/kblog/static?view=about']],
              ['label' => 'callback', 'url' => ['/kblog/callback']],
              ['label' => 'Test', 'url' => ['kblog/test']],

          ];
          echo Nav::widget
          ([
              'options' => ['class' => 'navbar-nav navbar-left'],
              'items' => $menuItems,
          ]);?>

          <ul class="col-md-2 col-sm-3 col-md-offset-2 col-sm-offset-0 kqf-search-form">
            <?php   //竖直
              $form = ActiveForm::begin([ 'type'=>ActiveForm::TYPE_HORIZONTAL,'formConfig'=>['deviceSize'=>ActiveForm::SIZE_SMALL], ]);
            ?>

                <?php echo $form->field($model, 'username', [
                    'showLabels'=>false,
                    'addon' => [
                        'append' => ['content'=>
                          '<button class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                            </button>',
                            'asButton'=>true,
                        ],
                    ]
                  ])->textInput(['placeholder'=>'输入要查找的内容',]);
                ?>
            <?php ActiveForm::end(); ?>
          </ul>

          <?php
            $menuItems = [];
            if (Yii::$app->user->isGuest)
            {
              $menuItems[] = [ 'label' => '登录', 'url' => ['/kblog/login'], ];
            }
            else
            {
              $menuItems[] =
              [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/kblog/logout'],
                'linkOptions' => ['data-method' => 'post'],
                'items' => [
                    [
                        'label' => '个人资料',
                        'url' => '/kblog/logout'
                    ],
                    [
                        'label' => '退出',
                        'url' => ['/user/default/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ],
              ];
            }
            echo Nav::widget
            ([
                'options' => ['class' => 'navbar-nav navbar-right','id'=>'logPlace'],
                'items' => $menuItems,
            ]);
            NavBar::end();
          ?>

      <div class="container" id="breadCrumbs">
        <?=
          Breadcrumbs::widget
          ([
              'encodeLabels' => false,
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              'homeLink' => ['label' => '<span class="glyphicon glyphicon-home"></span>', 'url' =>Yii::$app->homeUrl],
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
