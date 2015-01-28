<?php


use yii\helpers\html;

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use yii\widgets\Pjax;
use yii\widgets\Spaceless;


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Tabs;

use frontend\widgets\Alert;

use kartik\widgets\SideNav;

?>

<h2> Html::csrfMetaTags </h2>
<?= Html::csrfMetaTags() ?>

<h2> Breadcrumbs::widget </h2>
<?php
    //Breadcrumbs::widget([ 'links' => ['hfduisydfui'], ]);
    Breadcrumbs::widget
     ([
              'links' => ['link'],
     ])
?>

<h2>GridView </h2>
<?php
Pjax::begin();
 echo "GridView::widget(['...'])";
Pjax::end();
?>

     <?php Spaceless::begin(); ?>
      <div class="nav-bar">
            sdsfsdfsdf
          </div>
          <div class="content">
             sfsdfsdf
          </div>
     <?php Spaceless::end(); ?>

<h2> Progress::widget</h2>
<?= yii\bootstrap\Progress::widget(['percent' => 60, 'label' => 'test']) ?>

<h2> button::widget</h2>
<?= yii\bootstrap\button::widget(['label' => 'button']) ?>

<h2> Alert::begin</h2>
<?php Alert::begin(['options' => ['class' => 'alert-warning',],]); ?>
    <?php echo 'Say hello...'; ?>
<?php Alert::end(); ?>


<h2> Menu::widget</h2>
<?php
    Menu::widget([
         'items' => [
             // Important: you need to specify url as 'controller/action',
             // not just as 'controller' even if default action is used.
             ['label' => 'Home', 'url' => ['site/index']],
             // 'Products' menu item will be selected as long as the route is 'product/index'
             ['label' => 'Products', 'url' => ['product/index'], 'items' => [
                 ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                 ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
             ]],
             ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
         ],
     ]);
?>
<?php
 echo Tabs::widget([
    'items' => [
      [
          'label' => 'One',
             'content' => 'Anim pariatur cliche...',
              'active' => true
          ],
          [
              'label' => 'Two',
              'content' => 'asdfafafafd',
              'headerOptions' => ['jjj' => 'jjj'],
              'options' => ['id' => 'myveryownID'],
          ],
          [
              'label' => 'Dropdown',
              'items' => [
                   [
                       'label' => 'DropdownA',
                       'content' => 'DropdownA, Anim pariatur cliche...',
                   ],
                   [
                       'label' => 'DropdownB',
                      'content' => 'DropdownB, Anim pariatur cliche...',
                   ],
              ],
          ],
      ],
  ]);

    ?>
    <?php



 echo SideNav::widget([
     'items' => [
          [
              'url' => ['/site/index'],
              'label' => 'Home',
              'icon' => 'home'
          ],
          [
              'url' => ['/site/about'],
              'label' => 'About',
              'icon' => 'info-sign',
              'items' => [
                   ['url' => '#', 'label' => 'Item 1'],
                   ['url' => '#', 'label' => 'Item 2'],
              ],
          ],
      ],
  ]);

?>