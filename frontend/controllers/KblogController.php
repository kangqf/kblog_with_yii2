<?php

namespace frontend\controllers;

use frontend\models\ContactForm;

class KblogController extends \yii\web\Controller
{
  public function actions()
    {
        
            $this->layout = "aaa";
        
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
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
