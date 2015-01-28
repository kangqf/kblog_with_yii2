<?php
namespace api\versions\v1;

/**
 * iKargo API V1 Module
 *
 * @author Budi Irawan <budi@ebizu.com>
 * @since 1.0
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\versions\v1\controllers';
    public $defaultRoute = 'api';

    public function init()
    {
        parent::init();
    }
}
