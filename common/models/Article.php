<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kblog_article".
 *
 * @property integer $aid
 * @property integer $author_id
 * @property integer $category_id
 * @property integer $comment_id
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
 * @property integer $creat_time
 * @property integer $update_time
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'category_id', 'comment_id', 'set_index', 'set_top', 'set_recommend', 'click_count', 'status', 'creat_time', 'update_time'], 'integer'],
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
            'aid' => Yii::t('app', 'Aid'),
            'author_id' => Yii::t('app', 'Author ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'comment_id' => Yii::t('app', 'Comment ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', '这会是内容'),
            'tags' => Yii::t('app', 'Tags'),
            'keywords' => Yii::t('app', 'Keywords'),
            'summary' => Yii::t('app', 'Summary'),
            'set_index' => Yii::t('app', 'Set Index'),
            'set_top' => Yii::t('app', 'Set Top'),
            'set_recommend' => Yii::t('app', 'Set Recommend'),
            'click_count' => Yii::t('app', 'Click Count'),
            'status' => Yii::t('app', 'Status'),
            'creat_time' => Yii::t('app', 'Creat Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
}
