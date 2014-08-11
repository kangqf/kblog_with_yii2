<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kblog_user".
 *
 * @property integer $uid
 * @property string $name
 * @property string $password
 * @property string $email
 * @property string $avatar
 * @property integer $login_count
 * @property integer $last_user_login_id
 * @property integer $creat_time
 * @property integer $type_id
 * @property integer $staus
 * @property string $level
 * @property integer $open_id
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_count', 'last_user_login_id', 'creat_time', 'type_id', 'staus', 'open_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 50],
            [['avatar'], 'string', 'max' => 255],
            [['level'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户ID',
            'name' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'avatar' => '头像',
            'login_count' => '登陆次数',
            'last_user_login_id' => '上次登录ID',
            'creat_time' => '创建时间',
            'type_id' => '类型ID',
            'staus' => '状态',
            'level' => '级别',
            'open_id' => '第三方ID',
        ];
    }
}
