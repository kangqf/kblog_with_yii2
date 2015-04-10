<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace backend\web\widgets;
use Yii;
use yii\helpers\Html;

/**
 * 后台顶部导航栏菜单物件
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class HeaderNav extends \yii\base\Widget
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
        return $this->render('headerNav', [
            'options' => $this->options(),
            'message' => $this->message(),
//            'userInfo' => $this->userInfo(),
//            'searchForm' => $this->searchForm()
        ]);
    }

    /**
     * @return array
     * 查询得到的信息数据
     */
    public function message()
    {
        $message =  [
            'messages' => $this->getMessages(),
            'allMessageLink' => 'http://lbackend.com',
        ];
        return $message;
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
            'brandUrl' => Html::a(Yii::$app->name, Yii::$app->homeUrl , ['class' => 'logo']),
        ];

        return $options;
    }


    private function getMessages()
    {
        $messages = [
            [
                'senderGroup' => 'Group1',
                'senderAvatar' => 'http://www.gravatar.com/avatar/80874a37be561a3770ca39edaced7c66',
                'title' => 'message1',
                'time' => 'today',
            ],
            [
                'senderGroup' => 'Group2',
                'senderAvatar' => 'http://www.gravatar.com/avatar/80874a37be561a3770ca39edaced7c66',
                'title' => 'message2',
                'time' => 'today',
            ],
            [
                'senderGroup' => 'Group3',
                'senderAvatar' => 'http://www.gravatar.com/avatar/80874a37be561a3770ca39edaced7c66',
                'title' => 'message3',
                'time' => 'today',
            ],
            [
                'senderGroup' => 'Group3',
                'senderAvatar' => 'http://www.gravatar.com/avatar/80874a37be561a3770ca39edaced7c66',
                'title' => 'message3',
                'time' => 'today',
            ],
            [
                'senderGroup' => 'Group3',
                'senderAvatar' => 'http://www.gravatar.com/avatar/80874a37be561a3770ca39edaced7c66',
                'title' => 'message3',
                'time' => 'today',
            ],
            [
                'senderGroup' => 'Group3',
                'senderAvatar' => 'http://www.gravatar.com/avatar/80874a37be561a3770ca39edaced7c66',
                'title' => 'message3',
                'time' => 'today',
            ],
        ];

        return $messages;
    }
}