<?php

namespace api\versions\v1\controllers;

use yii\rest\ActiveController;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ApiController extends ActiveController
{
    public $modelClass = 'api\versions\v1\models\Country';
}
