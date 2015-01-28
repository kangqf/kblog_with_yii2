<?php

namespace backend\controllers;

use Yii;
use common\models\Article;
use common\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public function actions() {

        return [
            'upload' => [
                'class' => \xj\ueditor\actions\Upload::className(),
                'uploadBasePath' => '@webroot', //file system path
                'uploadBaseUrl' => \Yii::$app->params['backendDomain'], //web path
                'csrf' => true, //csrf校验
                'configPatch' => [
                    'imageMaxSize' => 500 * 1024, //图片
                    'scrawlMaxSize' => 500 * 1024, //涂鸦
                    'catcherMaxSize' => 500 * 1024, //远程
                    'videoMaxSize' => 1024 * 1024, //视频
                    'fileMaxSize' => 1024 * 1024, //文件
                    'imageManagerListPath' => '/', //图片列表
                    'fileManagerListPath' => '/', //文件列表
                ],
                'pathFormat' => [
                    'imagePathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'scrawlPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'catcherPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'videoPathFormat' => 'video/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'filePathFormat' => 'file/{yyyy}{mm}{dd}/{time}{rand:6}',
                ],
            ],
        ];
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->aid]);
        } else {
        return $this->render('view', ['model' => $model]);
}
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article;

        if ($model->load(Yii::$app->request->post())) {
           // dump(Yii::$app->getUser()->isGuest);die();
            $model->author_id = Yii::$app->user->getIdentity()->getId();
                if($model->save())
                    return $this->redirect(['view', 'id' => $model->aid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->aid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
