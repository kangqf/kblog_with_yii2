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
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 *
 * @property User $createdBy
 * @property Category $parent
 * @property Category[] $categories
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
            [['level', 'visual_able', 'order', 'parent_id', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cgid' => Yii::t('category', 'Cgid'),
            'name' => Yii::t('category', 'Name'),
            'level' => Yii::t('category', 'Level'),
            'visual_able' => Yii::t('category', 'Visual Able'),
            'order' => Yii::t('category', 'Order'),
            'parent_id' => Yii::t('category', 'Parent ID'),
            'created_at' => Yii::t('category', 'Created At'),
            'updated_at' => Yii::t('category', 'Updated At'),
            'created_by' => Yii::t('category', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['cgid' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'cgid']);
    }
}
