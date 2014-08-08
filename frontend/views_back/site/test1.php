<?php 
use kartik\widgets\SideNav;


 ?>

<?php $this->beginPage() ?>

<?php $this->head(); ?>

<?php $this->beginBody() ?>
<?php
 echo SideNav::widget([
     'items' => [
          [
              'url' => ['/site/index'],
              'label' => 'SideNav',
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




<?php $this->endBody() ?>

<?php $this->endPage() ?>