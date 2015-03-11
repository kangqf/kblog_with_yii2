<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
namespace frontend\widgets;
use Yii;
use yii\helpers\StringHelper;


/**
 * 全局导航菜单物件,用于链接在导航栏的各个模型的数据，并提供给界面
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class TopMenu extends \yii\base\Widget
{
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
    }
    /**
     * Renders the widget.
     */
    public function run()
    {

        return $this->render('topMenu', [
            'options' => $this->options(),
            'category' => $this->category(),
            'userInfo' => $this->userInfo(),
            'searchForm' => $this->searchForm()
        ]);
    }

    /**
     * @return array
     * 构建菜单栏分类数据
     */
    public function category()
    {
        $category = [

        ];
        return $category;
    }

    /**
     * @return array
     * 构建登录栏数据
     */
    private function userInfo()
    {
        if(Yii::$app->getUser()->isGuest){
            $userInfo = [
                [
                    'label' => '登录',
                    'url' => $user = Yii::$app->getUser()->loginUrl,
                ],
                [
                    'label' => '注册',
                    'url' => Yii::$app->params['registerUrl'],
//                'linkOptions' => [
//                    'id' => 'register',
//                    'data-toggle' => "modal",
//                    'data-target' => '#registerModal'
//                ]
                ],
            ];
        }
        else{
            $userInfo = [
                [
                    'label' => StringHelper::truncate(Yii::$app->user->identity->username, 5),
                    'active' => false,
                    'url' =>['/'],
                    'items' => [
                        [
                            'label' => '个人资料',
                            'url' => '#',
                        ],
                        [
                            'label' => '退出',
                            'url' => ['/signout'],
                        ],
                    ],
                ],
            ];
        }


        return $userInfo;
    }

    /**
     * @return array
     * 构建搜索框模型
     */
    private function searchForm()
    {
        $searchForm = [

        ];

        return $searchForm;
    }

    /**
     * @return array
     * 构建配置数据
     * options['brandUrl']
     *
     */
    private function options()
    {
        $options = [
            'brandUrl' => !Yii::$app->user->isGuest ? Yii::$app->urlManagerBackend->createUrl(['/backend/auth',
                [
                    'auth' => Yii::$app->user->getIdentity()->getAuthKey(),
                    'id' => Yii::$app->user->getId(),
                ],
            ]) : ['/index'],
        ];

        return $options;
    }
}