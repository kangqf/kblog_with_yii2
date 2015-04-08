<?php
return [
    'adminEmail' => 'kangqingfei@gmail.com',
    'supportEmail' => 'kangqingfei@gmail.com',
    'user.passwordResetTokenExpire' => 3600,
    'frontendDomain' => 'http://www.kangqingfei.cn',
    'backendDomain' => 'http://admin.kangqingfei.cn',
    //'uploadPath' => Yii::$app->basePath . '/uploads/',
    'uploadPath' =>  '@webroot/uploads/',
    'uploadUrl' => Yii::getAlias('@upload'),
    'defaultAvatar' => 'http://kangqingfei.qiniudn.com/default.jpg',
];
