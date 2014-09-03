<?php

namespace common\modules\user\modules\rbac\rules;

use Yii;

class NotGuestRule extends \yii\rbac\Rule
{
	/**
	 * @inheritdoc
	 */
	public $name = 'notGuestRule';

	/**
	 * @inheritdoc
	 */
    public function execute($user, $item, $params)
    {
        return !Yii::$app->user->isGuest;
    }
}
