<?php

namespace frontend\controllers;

use common\models\User;

class KblogController extends \yii\web\Controller
{

  public function actions()
    {
        return [

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

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        var_dump($attributes);
        die();
        // user login or signup comes here
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionLogin()
    {
        $userModel = new User();
        return $this->render('login',['model' => $userModel]);

    }
    //
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }
    public function actionError()
    {
      return $this->render('error');
    }




    public function actionInfo()
    {
        return $this->render('info');
    }

    public function actionTest()
    {
        return $this->renderPartial('test');
    }

    public function actionTest1()
    {
        $model = new User();
        return $this->renderPartial('test1',['model'=>$model,]);
    }


}
