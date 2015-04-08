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
use yii\base\InvalidCallException;
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
     //   $collection = Yii::$app->mongodb->getCollection('auth_user_attributes');
        //var_dump($collection->insert(['name' => 'John Smith', 'status' => 1]));
//        $collection->insert(['name' => '是倒萨大 Smith', 'status' => 1]);
//        $kkk = $collection->insert(['name' => 'CCC Smith', 'status' => 1]);
//        var_dump($collection->remove(["_id" => $kkk]));
        //Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
        //echo "<script> window.alert(\"注销成功，即将跳转到首页\");</script>";


        /** @var \callmez\file\system\Filesystem $local */
        // 集合方式
        //$local = Yii::$app->fileSystem->get('local');
        //$local->write('test.txt', 'hello world');
        //$text = $local->read('test.txt');

        /** @var \callmez\file\system\Filesystem $qiniu*/
//        $qiniu = Yii::$app->fileSystem->get('qiniu');
//        if($qiniu->has('test.txt'))
//        {
//            echo "has".$qiniu->read('test.txt');
//        }
//        else {
//            if($qiniu->write('test.txt', 'hello world'))
//            echo "create";
//        }
        //if($qiniu->copy('kk.jpg','jjj1.jpg')) {
        //if($qiniu->urlCopy('http://www.gravatar.com/avatar/f9ef5a98ba9d7539edf57fa8b5b400d5?s=500&d=retro','kkll.png')) {
//        if($qiniu->urlCopy('http://ww3.sinaimg.cn/crop.191.1.764.764.1024/c05c3ad5gw1ec9zga452wj20sg0lcqat.jpg','a7b50be662653148e1959424a8745f56.jpg')) {
//            echo "copy";
//        }
//        else{
//            echo "not copy";
//        }
//        if(Yii::$app->fileSystem->copy('local://test.txt', 'test/test2.txt')) {
//            echo "copy";
//        }
//        else{
//            echo "not copy";
//        }





        return $this->render('test');
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
     * @inheritdoc 相当于构造函数
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
            //需要处理的错误类型
            switch($loginModel->errorType){
                case LoginForm::ERROR_NON :
                    Yii::$app->session->setFlash('alert', '登录成功');
                    Yii::$app->session->setFlash('alert-type', 'alert-success');
                    break;
                case LoginForm::ERROR_WAITFINISH :
                    return $this->redirect(['finish-register','uid' => User::findByEmail($loginModel->email,User::STATUS_ALL)->user_id]);
                    break;
                default :
                    throw new InvalidCallException('login action error');
                    break;
            }
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
            Yii::$app->session->setFlash('alert-type', 'alert-success');
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
        $registerModel = new RegisterForm(['scenario' =>'register']);
        if (Yii::$app->request->isAjax && $registerModel->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($registerModel);
        }
        if ($registerModel->load(Yii::$app->request->post())) {
            $user = $registerModel->register();
            if ($user) {
                Yii::$app->session->setFlash('alert', '注册成功');
                Yii::$app->session->setFlash('alert-type', 'alert-success');
                if (Yii::$app->getUser()->login($user, 3600 * 24)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('register', ['model' => $registerModel,]);
    }

    public function actionFinishRegister($uid)
    {
        $registerModel = new RegisterForm(['scenario' =>'finishRegister']);
        if (Yii::$app->request->isAjax && $registerModel->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($registerModel);
        }
        if ($registerModel->load(Yii::$app->request->post())) {
            $user = $registerModel->finishRegister($uid);
            if ($user) {
                Yii::$app->session->setFlash('alert', '完成注册成功');
                Yii::$app->session->setFlash('alert-type', 'alert-success');
                if (Yii::$app->getUser()->login($user, 3600 * 24)) {
                    return $this->goHome();
                }
            } else {
                Yii::$app->session->setFlash('alert', '完成注册失败');
                Yii::$app->session->setFlash('alert-type', 'alert-danger');
                return $this->goHome();
            }
        } else {
            $newUser = User::findByUserId($uid,User::STATUS_WAITFINISH);
            if($newUser){
                $registerModel->email = $newUser->email;
                $registerModel->username = $newUser->username;
                $registerModel->avatar = $newUser->avatar;
            } else
                throw new InvalidCallException('user need not to be finished');
        }
        return $this->render('register', ['model' => $registerModel,'title' => '完成注册']);
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
                        Yii::$app->session->setFlash('alert-type', 'alert-success');
                        return true;
                    }
                }
            }
            //未曾进行过第三方登陆
            else {
                $uid = $openUser->registerUser();
                if($uid) {
                    return $this->$this->redirect(['finish-register','uid' => $uid]);
//                    Yii::$app->session->setFlash('alert', '注册成功');
//                    Yii::$app->session->setFlash('alert-type', 'alert-success');
//                    return true;
                } else{
                    Yii::$app->session->setFlash('alert', '注册失败');
                    Yii::$app->session->setFlash('alert-type', 'alert-danger');
                    return false;
                }
            }
        }
        return false;
    }

}
