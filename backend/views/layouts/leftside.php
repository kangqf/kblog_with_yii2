<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

use backend\web\widgets\AdminLTELeftNav;
/**
 * @var array $leftSideMenu
 */

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower') . '/adminlte';

?>


<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <!--    显示管理用户信息    -->
        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= Yii::$app->user->identity->username ?></p>
                    <a href="<?= $directoryAsset ?>/#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
        <?php endif ?>

        <?= AdminLTELeftNav::widget($leftSideMenu); ?>

    </section>

</aside>