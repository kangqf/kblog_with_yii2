<?php

namespace frontend\controllers;

use frontend\models\ContactForm;

class KblogController extends \yii\web\Controller
{
  public function actions()
    {
      //构造函数使用aaa Layout
      //$this->layout = "aaa";

    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
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
        $model = new ContactForm();
        return $this->renderPartial('test1',['model'=>$model,]);
    }


}
