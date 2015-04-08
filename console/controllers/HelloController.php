<?php
 /**
  * @link http://kangqingfei.com/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace console\controllers;

use yii\console\Controller;

/**
 * 没啥用的就是问个好
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class HelloController extends Controller
{
    /**
     * 默认方法
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }
}
