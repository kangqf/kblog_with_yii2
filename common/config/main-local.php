<?php
return [
    'components' => [

        //数据库配置
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=kblog',
            'username' => 'root',
            'password' => 'kqf911',
            'charset' => 'utf8',
            'tablePrefix' => 'kblog',
        ],
        //发送邮件配置
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
