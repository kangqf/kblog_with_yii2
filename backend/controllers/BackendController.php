<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */
namespace backend\controllers;

use Yii;
use backend\models\SystemInfo;
use common\models\User;

/**
 * 后台默认控制类
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class BackendController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('visitBackend')){
            $sysInfo = new systemInfo();
            $info = $sysInfo->save();
            $sysInfo->load($info);
            if (Yii::$app->request->isAjax) {
                return $sysInfo->getPhpInfo();
            }
            return $this->render('index', ['sysInfo' => $sysInfo]);
        } else {
            $url = Yii::$app->urlManagerFrontend->createUrl(['/',]);
            $this->redirect($url);
        }
    }

    public function actionAuth($auth_key, $id)
    {
        $userInfo = User::findByAuthKey($auth_key);
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

    public function actionLogin()
    {
        $url = Yii::$app->urlManagerFrontend->createUrl(['/signin',]);
        $this->redirect($url);
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
}
