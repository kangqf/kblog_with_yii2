<?php

/**
 *默认控制器
 */

namespace frontend\controllers;

use common\models\User;
use frontend\models\LoginForm;
use frontend\models\SignupForm;
use Yii;
use common\models\OpenUser;
use common\models\AvatarFile;


use frontend\models\Category;

class KblogController extends \yii\web\Controller
{

    public function actions()
    {
        return [
            //错误处理
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            // //验证码
            // 'captcha' => [
            //     'class' => 'yii\captcha\CaptchaAction',
            //     'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            // ],
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
        ];
    }

    //默认Action
    public function actionIndex()
    {
//        $data = Category::getTopCategory();
//        foreach($data as $value){
//            print_r($value->name);
//        }
//       // print_r($data);
//        die();
        // phpinfo();die();
        // $SearchModel = new SearchForm;
        //
        // $view = Yii::$app->view;
        // $view->params['SearchModel'] = $SearchModel;
        // dump($view);die();


        //$collection = Yii::$app->mongodb->getCollection('kblog');
        // dump($collection->findOne());
        // die();

        return $this->render('index');
    }

    //登录
    public function actionLogin()
    {
        $loginModel = new LoginForm();
        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', ['loginModel' => $loginModel]);
        }
    }

    public function  actionGetAvatar($file_name = '20140831214007_304de1027bcd348d087830217763712d.jpg', $size = 1)
    {
        $avatarFile = new AvatarFile();
        $row = $avatarFile->get($file_name, $size);
        if ($row) {
            header('Content-type: ' . $row['contentType']);
            return $row['byte'];
        } else {
            echo "";
        }


    }

    /**
     *注销
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * 注册
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {
                    // echo "<script> window.alert(\"注册成功，即将跳转到首页\");</script>";
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', ['model' => $model,]);
    }

    public function actionSearch()
    {
        return $this->render('search');
    }

    public function actionSignupFinish($email, $openid, $username, $avatar)
    {


        $response = Yii::$app->getResponse();
        $redirectPath = Yii::getAlias("@frontend/themes/default/views/kblog/") . 'redirect.php';
        $response->content = Yii::$app->getView()->renderFile($redirectPath, ['url' => 'index', 'enforceRedirect' => true]);
        return $response;

        // return $this->renser('signupFinish');
    }

    //第三方登陆回调函数
    public function successCallback($client = null)
    {
        if ($client === null) {
            return $this->render('index');
        } else {
            $openUser = new OpenUser($client);
            $user = User::findByOpenId($openUser->openId);
            //曾进行过第三方登陆
            if ($user !== null) {
                if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {

                    return true;
                }
            } //未曾进行过第三方登陆
            else {
                $avatarFileName = 'ss'; //$openUser->grabImage();
                if ($avatarFileName) {
//                    $signupModel = new SignupForm();
//                    $signupModel->avatar = Yii::getAlias("@webroot/avatar/") . $avatarFileName;
//                    $signupModel->email = $openUser->email;
//                    $signupModel->username = $openUser->name;
//                    $signupModel->openId = $openUser->openId;
                    echo "<script type=\'text/javascript\'> window.alert(\"第三方验证成功，即将关闭当前窗口，并跳转到完成注册页面\");</script>";
                    // $this->redirect('index');
                    $this->redirect(['signup-finish', 'email' => $openUser->email, 'openid' => $openUser->openId, 'username' => $openUser->name, 'avatar' => $avatarFileName]);

                } else {
                    echo "<script> window.alert(\"第三方登录抓取图片失败，即将关闭当前窗口，并跳转到首页\");</script>";
                    return false;
                }
            }
        }
    }


    // //关于页面
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

    // //错误处理动作
    // public function actionError()
    // {
    //   $exception = \Yii::$app->errorHandler->exception;
    //   if ($exception !== null) {
    //       return $this->render('error', ['exception' => $exception]);
    //   }
    // }
}
