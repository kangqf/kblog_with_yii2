<?php

namespace frontend\controllers;

use common\models\ArticleSearch;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex($cgid)
    {
        $searchModel = new ArticleSearch;
        //  $dataProvider = $searchModel->search( [ 'set_index' => '1']);
        $dataProvider = $searchModel->search( [
                'ArticleSearch' => [
//                'author_id' => '',
                'category_id' =>$cgid,
//                'title' => '',
//                    'set_index' => '1',
//                'set_top' => '',
//                'set_recommend' => '',
//                'click_count' => '',
//                'created_time' => '',
//                'updated_time' => '',
                ]
            ]
        );
        //  dump($dataProvider);die();


        return $this->render('index', [
            'dataProvider' => $dataProvider,
         //   'searchModel' => $searchModel,
        ]);
    }

}
