<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

namespace frontend\controllers;

use common\models\LoginForm;
use Yii;
use yii\bootstrap\modal;

/**
 * 前台默认控制器
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class FrontendController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string 默认方法
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * @return string|\yii\web\Response 登录方法
     */
    public function actionLogin()
    {
        $loginModel = new LoginForm();
        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login()) {
            Modal::begin([    'header' => '<h2>Hello world</h2>',    'toggleButton' => ['label' => 'click me'],]);
            echo 'Say hello...';
            Modal::end();
            return $this->goBack();
        }
        else {
            return $this->render('login', ['loginModel' => $loginModel]);
        }
    }

}
