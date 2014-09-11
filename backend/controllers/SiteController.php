<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use yii\filters\VerbFilter;

use mdm\admin\components\MenuHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'error', 'logout', 'index',],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['index'],
                        'allow' => true,
//                        'matchCallback' => function ($rule, $action) {
//                                dump($rule);dump($action);die();
//                               // return date('d-m') === '31-10';
//                            }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionAuth($user)
    {
        $userInfo = User::findByAuthKey($user);
        if ($userInfo && Yii::$app->user->login($userInfo)) {
            $url = Yii::$app->urlManager->createUrl(['',]);
            $this->redirect($url);

            //dump(MenuHelper::getAssignedMenu(Yii::$app->user->id));
            // die();

        } else {
            $url = Yii::$app->urlManagerFrontend->createUrl(['/kblog/index',]);
            $this->redirect($url);
        }

    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $url = Yii::$app->urlManagerFrontend->createUrl(['/kblog/index',]);
        $this->redirect($url);
    }
}
