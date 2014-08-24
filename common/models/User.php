<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "kblog_user".
 *
 * @property integer $uid
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $login_count
 * @property integer $status
 * @property integer $role
 * @property integer $open_id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * 用户状态
     * - 激活
     * - 未激活
     * - 禁止
     * - 删除
     */
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 9;
    const STATUS_BANNED = 1;
    const STATUS_DELETED = 0;

    /**
     * 用户级别
     */
    const ROLE_USER = 10;
    const ROLE_ORG = 9;
    const ROLE_ORGLEADER = 8;
    const ROLE_FIN = 7;
    const ROLE_ANALYTIC = 6;
    const ROLE_OPERATOR = 5;
    const ROLE_MANAGER = 4;
    const ROLE_MANAGLEADER = 3;
    const ROLE_SUPERMANAGER = 2;
    const ROLE_ADMIN = 1;
    const ROLE_SUPERADMIN = 0;

    /**
     * @var string 用户级别
     */
    protected $_role;

    /**
     * @var string 用户状态
     */
    protected $_status;

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
     * 规则，指定属性的验证规则
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['role'], 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_SUPERADMIN,self::ROLE_USER]],
            // [['auth_key', 'password_hash', 'role', 'status', 'email',
            // 'created_time', 'updated_time'], 'required', 'message'=>'用户信息不完整'],
            [['login_count', 'created_time', 'updated_time', 'role','status', 'open_id'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 50],
            [['email'],'email'],
            [['email'], 'unique', 'message'=>'该邮箱已被注册'],
            [['avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['password'], 'required', 'on' => ['create', 'signup']],
            [['username'], 'filter', 'on' => ['create', 'update'], 'filter' => function ($value) {
                    return ($newValue = trim($value)) && $newValue ? $newValue : null;
                }],


        ];
    }

    /**
     * @inheritdoc
     * 场景，针对不用场景，指定不同的激活属性
     */
    public function scenarios()
    {
        //$scenarios = parent::scenarios();
        //$scenarios['login'] = ['username', 'password'];
        return [

            'signup' => ['username','email', 'password','avatar','open_id','status', 'role','auth_key'],
             'login' => ['login_count'],
            // 'updated' => ['username', 'password'],
            // 'password_reset_request' => ['email'],
            // 'reset_password' => ['password'],
            // 'updated' => ['username', 'email', 'status', 'role', 'password', 'organization_id'],
            // 'created' => ['username', 'email', 'status', 'role', 'password', 'organization_id'],
            // 'delete' => [],
            ];
    }

    /**
     * @inheritdoc
     * 标签用于在widget中更好的显示
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户ID',
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'avatar' => '头像',
            'login_count' => '登陆次数',
            'created_time' => '创建时间',
            'updated_time'=> '上次登录时间',
            'status' => '状态',
            'role' => '级别',
            'open_id' => '第三方ID',
            'auth_key' =>'授权密钥',
            'password_hash' => '哈希密码',
            'password_reset_token' => '重设访问令牌',
        ];
    }



    /**
	   * 通过用户名查找用户身份
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //findOne是ActiveRecord的方法
        return self::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
	   * 通过邮箱查找用户
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }




    /**
     * 验证密码
     * @param  string  $password
     * @return boolean
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * 设置哈希密码
     * @param string $password
     */
    public function setHashPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * 生成验证密钥
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }

     /**
     * 生成重置令牌
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomString() . '_' . time();
    }

    /**
     * 移除重置令牌
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }




    /**
     * @return string 返回角色标签
     */
    public function getRoleLabel()
    {
        if ($this->_role === null) {
            $roles = self::getRoleArray();
            $this->_role = $roles[$this->role];
        }
        return $this->_role;
    }

    /**
     * @return array 返回角色标签数组
     */
    public static function getRoleArray()
    {
        return [
            self::ROLE_USER => '用户',
            self::ROLE_ORG => '员工',
            self::ROLE_ORGLEADER => '经理',
            self::ROLE_FIN => '金融管理者',
            self::ROLE_ANALYTIC => '分析师',
            self::ROLE_OPERATOR => '维护人员',
            self::ROLE_MANAGER => '管理',
            self::ROLE_MANAGLEADER => '主管',
            self::ROLE_SUPERMANAGER => '超级主管',
            self::ROLE_ADMIN => '管理员',
            self::ROLE_SUPERADMIN => '超级管理员'
            ];
    }

    /**
     * @return string 返回状态标签
     */
    public function getStatusLabel()
    {
        if ($this->_status === null) {
            $statuses = self::getStatusArray();
            $this->_status = $statuses[$this->status];
        }
        return $this->_status;
    }

    /**
     * @return array 返回状态标签数组
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => '激活',
            self::STATUS_INACTIVE => '未激活',
            self::STATUS_BANNED => '冻结',
            self::STATUS_DELETED => '删除',
            ];
    }




    /**
     * @inheritdoc
     * 必须继承的方法1，通过ID查找用户身份
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
        //return self::findOne($id);
    }

    /**
     * @inheritdoc
     * 必须继承的方法2，通过访问令牌查找用户身份，未实现
     */
    public static function findIdentityByAccessToken($token,$type = null)
    {
        //return static::findOne(['access_token' => $token]);
        throw new NotSupportedException('"findIdentityByAccessToken" 没有被实现.');
    }

    /**
     * @inheritdoc
     * 必须继承的方法3，返回可以唯一识别用户身份的ID
     */
    public function getId()
    {
        //getPrimaryKey在ActiveRecord中实现
        return $this->getPrimaryKey();
        //return $this->uid;
    }

    /**
     * @inheritdoc
     * 必须继承的方法4，返回授权密钥
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     * 必须继承的方法5，验证密钥
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
