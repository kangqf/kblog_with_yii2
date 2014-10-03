<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kblog_comment".
 *
 * @property integer $cid
 * @property integer $user_id
 * @property integer $article_id
 * @property integer $status
 * @property integer $creat_time
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
            [['user_id', 'article_id', 'status', 'creat_time'], 'integer'],
            [['message'], 'string'],
            [['ip'], 'string', 'max' => 15]
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
            'creat_time' => Yii::t('app', 'Creat Time'),
            'message' => Yii::t('app', 'Message'),
            'ip' => Yii::t('app', 'Ip'),
        ];
    }
}
