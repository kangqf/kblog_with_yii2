<?php

namespace frontend\controllers;

use common\models\Article;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = Article::findOne(['aid'=>$id]);
        return $this->render('index',['model' => $model]);
    }

}
