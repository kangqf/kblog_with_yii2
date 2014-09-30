<?php

use common\models\User;
use frontend\assets\ArticleAsset;

ArticleAsset::register($this);
?>

<div class="col-md-10 col-md-offset-1">
   <div class="col-md-2" id="author_info">
       <?= User::getAvatarById($model->author_id,80); ?>
   </div>


</div>