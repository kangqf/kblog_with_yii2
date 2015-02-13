<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $cgid
 * @property string $name
 * @property integer $level
 * @property integer $visual_able
 * @property integer $order
 * @property integer $parent_id
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'visual_able', 'order', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cgid' => Yii::t('common', 'Cgid'),
            'name' => Yii::t('common', 'Name'),
            'level' => Yii::t('common', 'Level'),
            'visual_able' => Yii::t('common', 'Visual Able'),
            'order' => Yii::t('common', 'Order'),
            'parent_id' => Yii::t('common', 'Parent ID'),
        ];
    }
}
