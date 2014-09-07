<?php
namespace common\rbac\components;

use Yii;
use yii\rbac\Role;

/**
 * 模块组件 [[RBAC]]
 */
class PhpManager extends \yii\rbac\PhpManager
{
	/**
	 * @inheritdoc
	 */
    //authFile已经被废除
    //public $authFile = '@common/rbac/data/rbac.php';

    public $itemFile = '@common/rbac/data/items.php';

    public $assignmentFile = '@common/rbac/data/assignments.php';

    public $ruleFile = '@common/rbac/data/rules.php';


    /**
	 * @inheritdoc
	 */
    public function init()
    {
        parent::init();

        $user = Yii::$app->getUser();
        if (!$user->isGuest) {
            $identity = $user->getIdentity();
            if (!$this->getAssignment($identity->role, $identity->getId())) {
                $role = new Role([
                    'name' => $identity->role
                ]);
                $this->revokeAll($identity->getId());
                $this->assign($role, $identity->getId());
            }
        }
    }
}