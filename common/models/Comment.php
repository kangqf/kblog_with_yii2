<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "kblog_comment".
 *
 * @property integer $cid
 * @property integer $user_id
 * @property integer $article_id
 * @property integer $status
 * @property integer $created_time
 * @property string $message
 * @property string $ip
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kblog_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'status', 'created_time'], 'integer'],
            [['message'], 'string'],
            [['ip'], 'string', 'max' => 15],
            [['status'], 'default', 'value' => 0],
        ];
    }

    public function behaviors()
    {
        return [

            //自动用当前时间戳填充制定字段
            'timestamp' => [
                //yii自己预定义的行为
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_time',],
                ],
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => Yii::t('app', 'Cid'),
            'user_id' => Yii::t('app', 'User ID'),
            'article_id' => Yii::t('app', 'Article ID'),
            'status' => Yii::t('app', 'Status'),
            'created_time' => Yii::t('app', 'Creat Time'),
            'message' => Yii::t('app', 'Message'),
            'ip' => Yii::t('app', 'Ip'),
        ];
    }

    public static function getCommentByArticleId($aid)
    {
        return self::findAll(['article_id' => $aid]);
    }
}
