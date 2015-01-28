<?php
namespace api\versions\v2;

/**
 * iKargo API V1 Module
 *
 * @author Budi Irawan <budi@ebizu.com>
 * @since 1.0
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\versions\v2\controllers';

    public function init()
    {
        parent::init();
    }
}
