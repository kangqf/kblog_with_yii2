<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "kblog_article".
 *
 * @property integer $aid
 * @property integer $author_id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $keywords
 * @property string $summary
 * @property integer $set_index
 * @property integer $set_top
 * @property integer $set_recommend
 * @property integer $click_count
 * @property integer $status
 * @property integer $created_time
 * @property integer $updated_time
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kblog_article';
    }

    public function behaviors()
    {
        return [

            //自动用当前时间戳填充制定字段
            'timestamp' => [
                //yii自己预定义的行为
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_time', 'updated_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_time'],
                ],
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'category_id', 'set_index', 'set_top', 'set_recommend', 'click_count', 'status', 'created_time', 'updated_time'], 'integer'],
            [['content'], 'required'],
            [['content', 'tags', 'keywords'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['summary'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => '文章ID',
            'author_id' => '作者',
            'category_id' => '类别',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'keywords' => '关键词',
            'summary' => '总结',
            'set_index' => '首页',
            'set_top' => '置顶',
            'set_recommend' => '推荐',
            'click_count' => '点击次数',
            'status' => '状态',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
}
