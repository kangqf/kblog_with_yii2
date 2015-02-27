<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

namespace frontend\controllers;

use common\models\LoginForm;
use Yii;
use frontend\models\RegisterForm;
use frontend\models\ResetPasswordForm;
use frontend\models\PasswordResetRequestForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\OpenUser;
use common\models\User;

/**
 * 前台默认控制器
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class FrontendController extends \yii\web\Controller
{
    /**
     * @return string 测试方法
     */
    public  function  actionTest(){
        //$collection = Yii::$app->mongodb->getCollection('customer');
        //var_dump($collection->insert(['name' => 'John Smith', 'status' => 1]));
        //Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
        //echo "<script> window.alert(\"注销成功，即将跳转到首页\");</script>";


        /** @var \callmez\file\system\Filesystem $local */
        // 集合方式
        //$local = Yii::$app->fileSystem->get('local');
        //$local->write('test.txt', 'hello world');
        //echo $local->read('test.txt');

        /** @var \callmez\file\system\Filesystem $qiniu */
        $qiniu = Yii::$app->fileSystem->get('qiniu');
        //$qiniu->write('test.txt', 'hello world');
        echo $qiniu->read('kk.jpg');


        //return $this->render('test');
    }

    /**
     * @inheritdoc
     * @return array
     */
    public function behaviors()
    {
        return [

            //ACF的配置
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'login'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'], //@代表已授权用户，?代表未授权用户（访客）
                    ],
                    [
                        'actions' => ['signup', 'signup-finish', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
//                 ACF错误回调函数
//                'denyCallback' => function () {
//                        throw new \Exception('You are not allowed to access this page 您没有被允许访问这个页面！');
//                 },
            ],

            //过滤器设置
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],

        ];
    }

    /**
     * @inheritdoc 相当于构造函数是
    */
    public function actions()
    {
        return [
            //错误处理
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            //静态页面的配置
            'static' => [
                'class' => '\yii\web\ViewAction',
            ],
            //第三方登录的配置
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
//                'successUrl' => Yii::$app->homeUrl,
            ],

//             //验证码
//             'captcha' => [
//                 'class' => 'yii\captcha\CaptchaAction',
//                 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//             ],
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
            Yii::$app->session->setFlash('alert', '登录成功');
            Yii::$app->session->setFlash('alert-type', 'alert-info');
            return $this->goBack();
        }
        else {
            return $this->render('login', ['loginModel' => $loginModel]);
        }
    }


    /**
     * @return \yii\web\Response 注销方法
     */
    public function actionLogout()
    {
        if(Yii::$app->user->logout()) {
            Yii::$app->session->setFlash('alert', '用户注销成功');
            Yii::$app->session->setFlash('alert-type', 'alert-info');
        } else{
            Yii::$app->session->setFlash('alert', '用户注销失败');
            Yii::$app->session->setFlash('alert-type', 'alert-danger');
        }

        return $this->goHome();
    }

    /**
     * @return array|string|\yii\web\Response 注册方法
     */
    public function actionRegister()
    {
        $registerModel = new RegisterForm();
        if (Yii::$app->request->isAjax && $registerModel->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($registerModel);
        }
        if ($registerModel->load(Yii::$app->request->post())) {
            if ($user = $registerModel->register()) {
                Yii::$app->session->setFlash('alert', '注册成功');
                Yii::$app->session->setFlash('alert-type', 'alert-info');
                if (Yii::$app->getUser()->login($user, 3600 * 24)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('register', ['model' => $registerModel,]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('alert', '邮件发送成功');
                Yii::$app->session->setFlash('alert-type', 'alert-success');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('alert', '邮件发送失败');
                Yii::$app->session->setFlash('alert-type', 'alert-danger');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('alert', '密码更新成功');
            Yii::$app->session->setFlash('alert-type', 'alert-success');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function finishRegister($model)
    {
        echo $this->render('finishRegister',['model' => $model]);
//        echo "finish";
//        var_dump($model);
//        die();
    }


    /**
     * 第三方登陆回调函数
     * @param null $client
     * @return bool|string
     */
    public function successCallback($client = null)
    {
        if ($client === null) {
            return $this->render('index');
        } else {
            $openUser = new OpenUser($client);
            $authUser = $openUser->isNewUser();
            //曾进行过第三方登陆
            if ($authUser) {
                /**  @var \common\models\User $user  */
                $user = User::findByUserId($authUser);
                $user->scenario = 'login';
                $user->login_count++;
                if ($user->save()) {
                    if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {
                        Yii::$app->session->setFlash('alert', '登录成功');
                        Yii::$app->session->setFlash('alert-type', 'alert-info');
                        return true;
                    }
                }
            }
            //未曾进行过第三方登陆
            else {

                //$this->finishRegister($openUser);
                echo $this->render('finishRegister',['model' => $openUser]);
            }
        }
        return false;
    }





    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false) {
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('create', [
            'model'=>$model,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFile = $model->getImageFile();
        $oldAvatar = $model->avatar;
        $oldFileName = $model->filename;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();

            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->avatar = $oldAvatar;
                $model->filename = $oldFileName;
            }

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false && unlink($oldFile)) { // delete old and overwrite
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->_id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // validate deletion and on failure process any exception
        // e.g. display an error message
        if ($model->delete()) {
            if (!$model->deleteImage()) {
                Yii::$app->session->setFlash('error', 'Error deleting image');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
