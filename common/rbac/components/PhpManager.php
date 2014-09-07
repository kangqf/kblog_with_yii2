<?php
namespace common\rbac\components;

use Yii;
use yii\rbac\Role;

/**
 * Файловый компонент модуля [[RBAC]]
 */
class PhpManager extends \yii\rbac\PhpManager
{
	/**
	 * @inheritdoc
	 */
	public $authFile = '@common/modules/user/modules/rbac/data/rbac.php';

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