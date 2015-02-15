<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */
namespace backend\controllers;

use Yii;
use backend\models\SystemInfo;

/**
 * 后台默认控制类
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class BackendController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $sysInfo = new systemInfo();
        $info = $sysInfo->save();
        $sysInfo->load($info);
        if (Yii::$app->request->isAjax) {
            return $sysInfo->getPhpInfo();
        }
        return $this->render('index', ['sysInfo' => $sysInfo]);
    }
}
