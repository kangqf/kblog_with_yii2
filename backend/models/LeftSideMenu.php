<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace backend\models;


/**
 * 用于生成左侧菜单栏
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class LeftSideMenu extends \yii\base\Component
{
    public function getLeftSideMenu()
    {
        return [
            'options' => ['class' => 'sidebar-menu'],
            'items' => [
                [
                    'label' => 'Server',
                    'url' => '/',
                    'fa' => [
                        'icon' => 'server',
                    ],
//                    'badge' => [
//                        'color' => 'red',
//                        'number' => 3,
//                    ],
                ],
                [
                    'label' => 'User',
                    'url' => '/user',
                    'fa' => [
                        'icon' => 'user',
                    ],
                    'items' => [

                        ['label' => 'create','url' => '/user/add'],
                        ['label' => 'update','url' => '/user/update'],
                        ['label' => 'set','url' => '/user/set'],
                    ],
                ],
                [
                    'label' => 'Category',
                    'url' => '/category',
                    'fa' => [
                        'icon' => 'briefcase',
                    ],
                    'items' => [
                        ['label' => 'All','url' => '/category/index'],
                        ['label' => 'Create','url' => '/category/create'],
                        ['label' => 'set','url' => '/category/set'],
                    ],
                ],
                [
                    'label' => 'Charts',
                    'fa' => [
                        'icon' => 'bar-chart-o',
                    ],
                    'items' => [
                        ['label' => 'Morris', 'url' => '#'],
                        ['label' => 'Flot action', 'url' => '#'],
                        ['label' => 'Inline charts', 'url' => '#'],
                    ],
                ],
            ],
            'encodeLabels' => false
        ];
    }
}