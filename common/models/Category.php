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
            'cgid' => 'ID',
            'level' => '菜单级别',
            'name' => '名称',
            'status' => '状态',
            'visual_able' => '是否可见',
            'parent_id' => '上级菜单',
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

    public static function getLevelArray() {
        return ['0'=>'一级','1'=>'二级'];
    }
    public static function getVisualEnableArray() {
        return ['0'=>'不可见','1'=>'可见'];
    }
    public static function getCategoryArray() {
        $obj = self::find()
            ->where(['status' => self::STATUS_ACTIVE,'level' => self::LEVEL_TOP])
            ->orderBy('cgid')
            ->all();
        return self::buildArray($obj);

    }
    public static function getAllCategoryArray() {
        $obj = self::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->orderBy('cgid')
            ->all();
        $pid = [];
        foreach($obj as $value)
        {
            if($value->parent_id)
            {
                $pid[] = $value->parent_id;
            }
        }
        $allCategory = self::buildArray($obj);

        foreach($pid as $pidValue){
            unset($allCategory[$pidValue]);
        }

        return $allCategory;

    }
    public static function getParentName($pid) {
        return self::find()
            ->where(['cgid' => $pid ,'status' => self::STATUS_ACTIVE,'level' => self::LEVEL_TOP])
            ->orderBy('cgid')
            ->one();
    }

    public static function buildArray($obj){
        $arr =[];
        foreach($obj as $value){
           // dump($value);
            $arr[$value->cgid] = $value->name;
        }
        return $arr;
    }

    public static function getTopCategoryArray(){
        $obj = self::getTopCategory();
        $arr =[0=>'顶级菜单'];
        foreach($obj as $value){
            $arr[$value->cgid] = $value->name;
        }
        return $arr;

    }
}
