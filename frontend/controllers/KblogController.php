<?php

namespace frontend\controllers;

use frontend\models\LoginForm;
use frontend\models\SignupForm;
use Yii;

class KblogController extends \yii\web\Controller
{

  public function actions()
    {
        return [
          //错误处理
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            //验证码
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            //静态页面的配置
            'static' => [
                'class' => '\yii\web\ViewAction',
            ],
            //第三方登录的配置
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    //第三方登陆回调函数
    public function successCallback($client = null)
    {
        if($client === null)
          return $this->render('index');
        else
        {
          $attributes = $client->getUserAttributes();
          dump($attributes);

        }

        die();
        // user login or signup comes here
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionLogin()
    {
        $loginModel = new LoginForm();
        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login())
        {
            return $this->goBack();
        }
        else
        {
            return $this->render('login',['loginModel' => $loginModel]);
        }

    }

    /**
     * 注册
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {
                if (Yii::$app->getUser()->login($user))
                {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', ['model' => $model,]);
    }

    // //关于页面
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }


    // //错误处理动作
    // public function actionError()
    // {
    //   $exception = \Yii::$app->errorHandler->exception;
    //   if ($exception !== null) {
    //       return $this->render('error', ['exception' => $exception]);
    //   }
    // }




    // public function actionInfo()
    // {
    //     return $this->render('info');
    // }
    //
    // public function actionTest()
    // {
    //     return $this->render('info');
    // }
    //
    // public function actionTest1()
    // {
    //     $model = new User();
    //     return $this->renderPartial('test1',['model'=>$model,]);
    // }


}
