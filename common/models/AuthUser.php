<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%auth_user}}".
 *
 * @property string $auth_user_id
 * @property string $type
 * @property integer $uid
 * @property string $detail_info_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $u
 */
class AuthUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_user}}';
    }


    public static function findByOpenId($openId)
    {
        return self::findOne(['auth_user_id' => $openId,]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_user_id', 'type'], 'required'],
            [['uid', 'created_at', 'updated_at'], 'integer'],
            [['auth_user_id', 'type', 'detail_info_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            //自动用当前时间戳填充制定字段
            'timestamp' => [
                //yii自己预定义的行为
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            'auth_user_id' => Yii::t('AuthUser', 'Auth User ID'),
            'type' => Yii::t('AuthUser', 'Type'),
            'uid' => Yii::t('AuthUser', 'Uid'),
            'detail_info_id' => Yii::t('AuthUser', 'Detail Info ID'),
            'created_at' => Yii::t('AuthUser', 'Created At'),
            'updated_at' => Yii::t('AuthUser', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'uid']);
    }
}
