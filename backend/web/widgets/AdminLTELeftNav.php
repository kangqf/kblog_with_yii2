<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace backend\web\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\bootstrap\Nav;

/**
 * 可用于生成AdminLTE的左侧导航窗口的小物件
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class AdminLTELeftNav extends Nav
{
    /**
     * @var array the dropdown widget options
     */
    public $dropdownOptions = [];
    /**
     * @var string fontawesome的图标
     */
    public $fa = [];
    /**
     * @var array 右边标记
     */
    public $badge = [];

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        Html::removeCssClass($this->options, 'nav');
        Html::addCssClass($this->options, 'sidebar-menu');
    }

    /**
     * @inheritdoc
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $fa = ArrayHelper::getValue($item, 'fa', []);
        $badge = ArrayHelper::getValue($item, 'badge', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if ($items !== null) {
            //具有二级菜单
            Html::addCssClass($options, 'treeview');
            $fa['rightIcon'] = 'angle-left';

            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }
                $dropdownOptions = ArrayHelper::merge($this->dropdownOptions, [
                    'items' => $items,
                    'encodeLabels' => $this->encodeLabels,
                    'clientOptions' => false,
                    'view' => $this->getView(),
                ]);
                $items = \backend\web\widgets\AdminLTEDropdown::widget($dropdownOptions);
            }

        }

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        $label = Html::tag('span',$label);

        if (!empty($fa)) {
            //左边图标
            if(!empty($fa['icon'])) {
                $labelOptions = [];
                Html::addCssClass($labelOptions, ' fa fa-' . $fa['icon']);
                $labelIcon = Html::tag('i', '', $labelOptions);
                $label = $labelIcon . $label;
            }
            //二级菜单右边图标
            if(!empty($fa['rightIcon'])) {
                $labelOptions = [
                    'class' => 'pull-right'
                ];
                Html::addCssClass($labelOptions,'fa fa-' . $fa['rightIcon'] );
                $labelIcon = Html::tag('i', '', $labelOptions);
                $label =  $label.$labelIcon;
            }
        }
        //气泡提示
        if(!empty($badge))
        {
            $badgeOptions = [];
            Html::addCssClass($badgeOptions,'badge pull-right bg-' . $badge['color']);
            $labelbadge = Html::tag('small',$badge['number'],$badgeOptions);
            $label = $label.$labelbadge;
        }
        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }

    /**
     * @inheritdoc
     */
    protected function isChildActive($items, &$active)
    {
        foreach ($items as $i => $child) {
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
            }
            if (isset($items[$i]['items']) && is_array($items[$i]['items'])) {
                $childActive = false;
                $items[$i]['items'] = $this->isChildActive($items[$i]['items'], $childActive);
                if ($childActive) {
                    Html::addCssClass($items[$i]['options'], 'active');
                    $active = true;
                }
            }
        }
        return $items;
    }
}