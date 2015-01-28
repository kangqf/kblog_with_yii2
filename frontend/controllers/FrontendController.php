<?php
/**
 * @link http://kangqingfei.com/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

namespace frontend\controllers;

/**
 * 前台默认控制器
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class FrontendController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
