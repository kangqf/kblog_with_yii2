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

use yii\filters\VerbFilter;
use yii\filters\AccessControl;


use frontend\models\Category;

class KblogController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            //ACF的配置
            'access' => [
                'class' => AccessControl::className(),
                //ACF错误回调函数
//                'denyCallback' => function () {
//                        throw new \Exception('You are not allowed to access this page 您没有被允许访问这个页面！');
//                    },
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
                        'roles' => ['?'], //@代表已授权用户，?代表未授权用户（访客）
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],

        ];
    }

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
            echo "<script> window.alert(\"登陆成功，即将跳转到前页\");</script>";
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
        echo "<script> window.alert(\"注销成功，即将跳转到首页\");</script>";
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
                    echo "<script> window.alert(\"注册成功，即将跳转到首页\");</script>";
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
        $signupModel = new SignupForm();
        if (!empty($openid)) {
            $signupModel->avatar = $avatar;
            $signupModel->email = $email;
            $signupModel->username = $username;
            $signupModel->openId = $openid;
        }
        if ($signupModel->load(Yii::$app->request->post())) {
            if ($user = $signupModel->signup()) {
                if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {
                    echo "<script> window.alert(\"注册成功，即将跳转到首页\");</script>";
                    $response = Yii::$app->getResponse();
                    $redirectPath = Yii::getAlias("@frontend/themes/default/views/kblog/") . 'redirect.php';
                    $response->content = Yii::$app->getView()->renderFile($redirectPath, ['url' => 'index', 'enforceRedirect' => true]);
                    return $response;
                }
            }
        }
        return $this->render('signupFinish', ['model' => $signupModel,]);
    }

    //第三方登陆回调函数
    public function successCallback($client = null)
    {
        // dump($client->getUserAttributes());die();
        if ($client === null) {
            return $this->render('index');
        } else {
            $openUser = new OpenUser($client);
            $user = User::findByOpenId($openUser->openId);
            //曾进行过第三方登陆
            if ($user != null) {
                $user->scenario = 'login';
                $user->login_count++;
                if ($user->save()) {
                    if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {
                        return true;
                    }
                }
            } //未曾进行过第三方登陆
            else {
                $avatarFileName = $openUser->grabImage();
                if ($avatarFileName) {
                    echo "<script type=\'text/javascript\'> window.alert(\"第三方验证成功，即将关闭当前窗口，并跳转到完成注册页面\");</script>";
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
