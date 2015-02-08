<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace common\rbac;

use Yii;

/**
 * 用于管理RBAC的类
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class AuthManager extends \yii\rbac\DbManager
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        //if (!Yii::$app->user->isGuest) {
            //我们假设用户的角色是存储在身份
           // $this->assign(Yii::$app->user->identity->id, Yii::$app->user->identity->role);
       // }

//        $user = Yii::$app->getUser();
//        if (!$user->isGuest) {
//            $identity = $user->getIdentity();
//            if (!$this->getAssignment($identity->role, $identity->getId())) {
//                $role = new Role([
//                    'name' => $identity->role
//                ]);
//                $this->revokeAll($identity->getId());
//                $this->assign($role, $identity->getId());
//            }
//        }
    }

}