<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
use yii\bootstrap\modal;
echo "dafasd";
 Modal::begin([
    'id' => 'modal',
    'size' => Modal::SIZE_LARGE,
    'header' => '<h2>' . Yii::t('back', 'Create {modelClass}', compact('modelClass')) . '</h2>'
]); ?>

<div id="modalContent"></div>

<?php Modal::end();
Modal::begin([    'header' => '<h2>Hello world</h2>',]);
echo 'Say hello...';
Modal::end();
?>