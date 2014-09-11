<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use backend\assets\defaultLayoutAsset;


DefaultLayoutAsset::register($this);


$this->title = "KAdmin";

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
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => ['id' => 'brand', 'class' => 'pull-left',],
            'options' => ['class' => 'navbar-inverse', 'id' => 'navbar'],
        ]);
    $menuItems =
        [
            [
                'label' => '系统信息',
                'url' => ['/site/index'],
            ]
        ];


    echo Nav::widget
        ([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);
    ?>




    <?php
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems = [['label' => '登录', 'url' => ['/site/login'],],];
    } else {
//                $user = Yii::$app->user->identity;
//                if($user != null){
//                    echo Html::img(
//                        Url::toRoute(['get-avatar', 'file_name' => $user->avatar, 'size' => 1], false), ['id' => 'avatar', 'alt' => $user->username]
//                    );
//                }

        $menuItems[] =
            [
                'label' => StringHelper::truncate(Yii::$app->user->identity->username, 5),
                //  'linkOptions' => ['data-method' => 'post'],
                'items' => [
                    [
                        'label' => '个人资料',
                        'url' => '/site/logout'
                    ],
                    [
                        'label' => '退出',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ],
            ];
    }
    echo Nav::widget
        ([
            'options' => ['class' => 'navbar-nav navbar-right', 'id' => 'logPlace'],
            'items' => $menuItems,
        ]);
    NavBar::end();
    ?>


    <!--    内容-->

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
