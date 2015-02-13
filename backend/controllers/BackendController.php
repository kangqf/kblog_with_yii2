<?php

namespace backend\controllers;

class BackendController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
