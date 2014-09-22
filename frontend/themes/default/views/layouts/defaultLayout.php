<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DefaultLayoutAsset;
use kartik\widgets\ActiveForm;
use common\models\Category;
use frontend\models\SearchForm;

use yii\helpers\Url;

DefaultLayoutAsset::register($this);

$this->title = "KBlog";
$SearchModel = new SearchForm;

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
            'brandUrl' => Yii::$app->user->can("accessBackend") ? Yii::$app->urlManagerBackend->createUrl(['/site/auth', 'user' => Yii::$app->user->getIdentity()->getAuthKey()]) : ['index'],
            'brandOptions' => ['id' => 'brand', 'class' => 'pull-left',],
            'options' => ['class' => 'navbar-inverse', 'id' => 'navbar'],
        ]);
    $menuItems =
        [
            [
                'label' => 'Home',
                'url' => ['/kblog/index'],
            ]
        ];

    $topMenu = Category::getTopCategory();
    foreach ($topMenu as $topValue) {
        $secondMenu = Category::getSecondCategory($topValue->cgid);
        $secondItems = [];
        foreach ($secondMenu as $secondValue) {
            $secondItems[] = [
                'label' => $secondValue->name,
                'url' => ['/category/' . $secondValue->cgid],
            ];
        }
        if ($secondItems != null) {
            $menuItems[] = [
                'label' => $topValue->name,
                // 'url' => ['/category/'.$topValue->cgid],
                'linkOptions' => ['data-method' => 'get'],
                'items' => $secondItems,
            ];
        } else {
            $menuItems[] = [
                'label' => $topValue->name,
                'url' => ['/category/' . $topValue->cgid],
                'linkOptions' => ['data-method' => 'get'],
            ];
        }
    }

    $menuItems[] = [
        'label' => 'About',
        'url' => ['/kblog/static?view=about'],
    ];

    echo Nav::widget
        ([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);?>

    <ul class="col-md-2 col-sm-2 col-md-offset-0 col-sm-offset-0 kqf-search-form">
        <?php //竖直
        $form = ActiveForm::begin(['action' => '/kblog/search', 'type' => ActiveForm::TYPE_HORIZONTAL, 'formConfig' => ['deviceSize' => ActiveForm::SIZE_SMALL],]);
        ?>

        <?php echo $form->field($SearchModel, 'keyWord', [
            'showLabels' => false,
            'addon' => [
                'append' => ['content' =>
                    '<button class="btn btn-default">
                      <i class="glyphicon glyphicon-search"></i>
                      </button>',
                    'asButton' => true,
                ],
            ]
        ])->textInput(['placeholder' => '输入要查找的内容',]);
        ?>
        <?php ActiveForm::end(); ?>
    </ul>




    <?php


    ?>



    <?php
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems = [['label' => '登录', 'url' => ['/kblog/login'],], ['label' => '注册', 'url' => ['/kblog/signup'],]];
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
                // 'url' => ['/kblog/logout'],
                'linkOptions' => ['data-method' => 'post'],
                'items' => [
                    [
                        'label' => '个人资料',
                        'url' => '/kblog/logout'
                    ],
                    [
                        'label' => '退出',
                        'url' => ['/kblog/logout'],
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

    <div class="container" id="breadCrumbs">
        <?=
        Breadcrumbs::widget
            ([
                'encodeLabels' => false,
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'homeLink' => ['label' => '<span class="glyphicon glyphicon-home"></span>', 'url' => Yii::$app->homeUrl],
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
