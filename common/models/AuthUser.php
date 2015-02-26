<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%auth_user}}".
 *
 * @property string $auth_user_id
 * @property string $type
 * @property integer $uid
 * @property integer $detail_info_id
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_user_id', 'type'], 'required'],
            [['uid', 'detail_info_id', 'created_at', 'updated_at'], 'integer'],
            [['auth_user_id', 'type'], 'string', 'max' => 255]
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
    public function getU()
    {
        return $this->hasOne(User::className(), ['user_id' => 'uid']);
    }
}
