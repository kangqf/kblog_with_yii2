<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kblog_category".
 *
 * @property integer $cgid
 * @property integer $level
 * @property string $name
 * @property integer status
 * @property integer $visual_able
 * @property integer $parent_id
 */
class Category extends \yii\db\ActiveRecord
{


    const STATUS_ACTIVE = 1;


    const LEVEL_TOP = 0;
    const LEVEL_SECOND = 1;

    const VISUAL_DISABLE = 0;
    const VISUAL_ENABLE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kblog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'default', 'value' => 0],
            [['visual_able'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'default', 'value' => self::VISUAL_ENABLE],


            [['level', 'status', 'visual_able', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cgid' => 'Cgid',
            'level' => 'Level',
            'name' => 'Name',
            'status' => 'status',
            'visual_able' => 'Visual Able',
            'parent_id' => 'Parent ID',
        ];
    }

    public static function getTopCategory(){
        return self::find()
            ->where(['status' => self::STATUS_ACTIVE,'level' => self::LEVEL_TOP])
            ->orderBy('cgid')
            ->all();
    }
    public static function getSecondCategory($parentId) {
        return self::find()
            ->where(['parent_id' => $parentId ,'status' => self::STATUS_ACTIVE,'level' => self::LEVEL_SECOND])
            ->orderBy('cgid')
            ->all();
    }
}
