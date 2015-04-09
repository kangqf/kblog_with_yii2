<?php
return [
    'adminEmail' => 'kangqingfei@gmail.com',
    'supportEmail' => 'kangqingfei@gmail.com',
    'user.passwordResetTokenExpire' => 3600,
    'frontendDomain' => 'http://lfrontend.com',
    'backendDomain' => 'http://lbackend.com',
    //'uploadPath' => Yii::$app->basePath . '/uploads/',
    'uploadPath' =>  '@webroot/uploads/',
    'uploadUrl' => Yii::getAlias('@upload'),
    'defaultAvatar' => 'http://kangqingfei.qiniudn.com/default.jpg',
];
