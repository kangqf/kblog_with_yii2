<?php

namespace frontend\controllers;

use Yii;
use common\models\Article;
use frontend\models\CommentForm;
use kartik\markdown\Markdown;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = Article::findOne(['aid'=>$id]);
        Article::plusClickCountByArticleId($id);
        $comment = new CommentForm();
        if ($comment->load(Yii::$app->request->post()) && $comment->comment()) {
            Yii::$app->view->registerJs('$("#comment-success").modal("show")');
            $comment = new CommentForm();
        }
        return $this->render('index', ['model' => $model, 'comment' => $comment]);
    }


//    public function actionComment()
//    {
//
//        if (Yii::$app->request->isAjax) {
//            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            if ($re = Yii::$app->request->post()) {
//                return ['comment' => Markdown::convert($re['comment']),];;
//            }
//
//            return ['id' => 'kqf'];
//        } else {
//            return "is not a ajax";
//        }
//    }

}
