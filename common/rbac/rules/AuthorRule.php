<?php

namespace common\modules\user\modules\rbac\rules;

class AuthorRule extends \yii\rbac\Rule
{
	/**
	 * @inheritdoc
	 */
	public $name = 'author';

	/**
	 * @inheritdoc
	 */
    public function execute($user, $item, $params)
    {
        return isset($params['model']) ? $params['model']['author_id'] == $user : false;
    }
}
