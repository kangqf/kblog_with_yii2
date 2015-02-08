<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
namespace frontend\widgets;


/**
 * 全局导航菜单物件
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class TopMenu extends \yii\base\Widget
{
//    /**
//     * @var array list of items in the nav widget
//     */
//    public $items = [];
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

        return $this->render('topMenu', ['items' => $this->items()]);
    }
    public function items()
    {
        $items = [];
        return $items;
    }
}