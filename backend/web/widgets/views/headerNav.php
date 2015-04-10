<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

use yii\helpers\Html;
use yii\helpers\StringHelper;

//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower') . '/adminlte';


?>

<header class="header">
    <!-- 导航栏左侧logo -->
    <?= $options['brandUrl'] ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <!--   leftside 触发按钮     -->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <!-- 导航栏右侧 -->
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <!-- 信息 -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-success"><?= sizeof($message['messages'])?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">你有 <?= sizeof($message['messages'])?> 条未读消息</li>
                        <!-- inner menu: contains the actual data -->
                        <li>
                            <ul class="menu">
                                <?php foreach( $message['messages'] as $messageValue){?>
                                <li>

                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?= $messageValue['senderAvatar'] ?>" class="img-circle" alt="User Image"/>
                                            </div>
                                            <h4>
                                                <?= $messageValue['senderGroup'] ?>
                                                <small><i class="fa fa-clock-o"></i> <?= $messageValue['time'] ?> </small>
                                            </h4>
                                            <p> <?= $messageValue['title'] ?></p>
                                        </a>
                                <?php }?>
                                </li>
                            </ul>
                        </li>
                        <!-- end message -->
                        <li class="footer"><a href="<?= $message['allMessageLink'] ?>">查看所有消息</a></li>
                    </ul>
                </li>

                <!--  注意事项 Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-warning"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page
                                        and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users warning"></i> 5 new members joined
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios7-cart success"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios7-person danger"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>

                <!-- 任务 Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>

                <?php
                if (Yii::$app->user->isGuest) {
                    ?>
                    <li class="footer">
                        <?= Html::a('Login', ['/login']) ?>
                    </li>
                <?php
                } else {
                    ?>
                    <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?= \Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="<?= Yii::$app->user->identity->avatar ?>" class="img-circle" alt="User Image"/>
                            <p>
                                <?= StringHelper::truncate(\Yii::$app->user->identity->username, 20) ?> -
                                <?= \common\models\User::getRoleArray()[\Yii::$app->user->identity->role]; ?>
                                <small>上次登录：<?= date("Y-m-d H:i",\Yii::$app->user->identity->updated_at) ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">链接一</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">链接二</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">链接三</a>
                            </div>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">个人资料</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a('注销', ['/signout'], ['data-method' => 'post','class'=>'btn btn-default btn-flat']) ?>
                            </div>
                        </li>
                    </ul>
                    </li><?php
                }
                ?>
                <!-- User Account: style can be found in dropdown.less -->
            </ul>
        </div>
    </nav>
</header>
