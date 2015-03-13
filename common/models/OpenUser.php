<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace common\models;

use MongoId;
use Yii;
use common\models\AuthUser;
use common\models\User;
use yii\helpers\StringHelper;
use yii\web\NotAcceptableHttpException;

/**
 * 用于提取第三方登录用户信息
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class OpenUser extends \yii\base\Model
{
    public $openId;
    public $avatar;
    public $username;
    public $email;
    public $type;
    public $attributes;

    /**
     * @param \yii\authclient\BaseClient $client
     */
    function __construct($client)
    {
        /**
         * 初始化模型参数
         */
        $this->attributes = $client->getUserAttributes();
        $this->type = $client->getId();
        switch ($this->type) {
            case 'tencent':
                $this->openId = $this->attributes['openid'];
                $this->avatar = $this->attributes['figureurl_2'] . '.png';
                $this->username = $this->attributes['nickname'];
                $this->email = '';
                break;

            case 'weibo':
                $this->openId = $this->attributes['id'];
                $this->avatar = strpos($this->attributes['avatar_hd'], '.jpg') ? $this->attributes['avatar_hd'] : $this->attributes['avatar_hd'] . '.jpg';
                $this->username = $this->attributes['name'];
                $this->email = '';
                break;

            case 'github':
                $this->openId = $this->attributes['id'];
                $this->avatar = $this->attributes['avatar_url'] . '.jpg';
                $this->username = $this->attributes['name'];
                $this->email = $this->attributes['email'];
                break;

            case 'google':
                $this->openId = $this->attributes['id'];
                $this->avatar = str_replace("?sz=50", "", str_replace("https://", "http://", $this->attributes['image']['url']));
                $this->username = $this->attributes['displayName'];
                $this->email = $this->attributes['emails'][0]['value'];
                break;

            default:
                $this->openId = '';
                $this->avatar = '';
                $this->username = '';
                $this->email = '';
                break;
        }
        /**
         * 检查模型的邮箱和名字是否存在
         */
        $this->checkEmail();
        $this->checkUserName();
    }

    /**
     * 邮箱注册过则将邮箱置空
     */
    protected function checkEmail(){
        if(User::findByEmail($this->email)){
            $this->email = '';
        }
    }

    /**
     * 名称存在则将名称加上openid
     */
    protected function checkUserName(){
        if(User::findByUsername($this->username)){
            $this->username .= StringHelper::truncate($this->openId, 5);
        }
    }

    /**
     * @return MongoId
     * @throws \yii\mongodb\Exception
     */
    public function storeAttributeToMongoDB()
    {
        /** @var \yii\mongodb\Collection $collection */
        $collection = Yii::$app->mongodb->getCollection('auth_user_attributes');
        return $collection->insert($this->attributes);
    }

    protected function removeAttributeToMongoDB($line)
    {
        /** @var \yii\mongodb\Collection $collection */
        $collection = Yii::$app->mongodb->getCollection('auth_user_attributes');
        return $collection->remove($line);
    }

    public function getAvatarType($filename = '')
    {
        $name = $filename ? $filename : $this->avatar;
        $extName = strrchr($name, "."); //获取扩展名
        $ext_arr = [".gif", ".png", ".jpg", ".bmp"];
        if (in_array($extName, $ext_arr))//判断扩展名是否为图片
            return $extName;
        else
            return false;
    }

    /**
     * 该第三方用户是否是第一次进行登录
     * @return static
     */
    public function isNewUser()
    {
        /**
         * 使用用户第三方ID和第三方登录的类型来唯一确定一名用户
         */
        $authUser = AuthUser::findByOpenId(['auth_user_id' => $this->openId,'type' => $this->type]);
        return $authUser ? $authUser->uid : null;
    }

    /**
     * 抓取图片
     * @return bool
     */
    public function fetchAvatar()
    {
        //判断图片类型，按理第三方登录的都能抓取到类型
        $type = $this->getAvatarType();
        if($type) {
            $ident = $this->email?md5($this->email):md5($this->openId);
            $key = $ident . $type;//date('YmdHis') .
        }
        else {
            $this->avatar = 'default';//获取图片类型失败 使用默认头像
            return true;
        }

        $qiniu = Yii::$app->fileSystem->get('qiniu');
        if($qiniu->has($key) || $qiniu->urlCopy($this->avatar,$key)) {
            $this->avatar = $qiniu->getUrl($key);
            return true;
        }
        else {
            if($this->email){
                //如果获取到地址则尝试抓取gavatar到七牛云
                if($qiniu->urlCopy('http://www.gravatar.com/avatar/' . md5($this->email) . '?s=500&d=retro',md5($this->email))) {
                    $this->avatar = $qiniu->getUrl($key);
                    return true;
                }
                else {
                    $this->avatar = 'http://www.gravatar.com/avatar/' . md5($this->email);//存储gavatar失败 使用gavatar地址
                    return true;
                }
            }
            else {
                $this->avatar =  $qiniu->getUrl('default.jpg');//存使用默认头像
                return true;
            }
        }
    }

    /**
     * 建立用户记录
     * @return bool|User
     */
    public function createUser(){
        $user = new User(['scenario' => 'register']);
        $user->username = $this->username;
        $user->email = $this->email;
        $user->avatar = $this->avatar;
        $user->status = 9;
        $user->generateAuthKey();
        $user->generateAccessToken();
        if ($user->save()) {
            return $user;
        }
        else {
            return false;
        }
    }

    /**
     * 建立第三方用户注册记录
     * @param $uid
     * @param $detailId
     * @return bool|AuthUser
     */
    public function createAuthUser($uid,$detailId){
        $user = new AuthUser();
        $user->uid = $uid;
        $user->detail_info_id = $detailId;
        $user->type = $this->type;
        $user->auth_user_id = strval($this->openId);
        //var_dump($user->save());die();
        if ($user->save()) {
            return $user;
        }
        else {
            return false;
        }
    }

    /**
     * 注册用户，分别写入User表 和Detail_info表 和Auth_User
     * @return bool
     * @throws NotAcceptableHttpException
     * @throws \Exception
     */
    public function registerUser(){
        $this->fetchAvatar();//先抓取头像
        $detail_id = $this->storeAttributeToMongoDB(); //将详细信息存进MongoDB
        if($detail_id) {
            $user = $this->createUser();
            if($user) {
                $authUser  = $this->createAuthUser($user->getId(),$detail_id->{'$id'});
                if($authUser){
//                    if (Yii::$app->getUser()->login($user, 3600 * 24)) {
//                        return true;
//                    }
                    return $user->user_id;
                } else {
                    //创建失败则删除新创建的用户
                    if($user->delete()){
                        if($this->removeAttributeToMongoDB(['_id' => $detail_id])){
                            return false;
                        } else{
                            throw new NotAcceptableHttpException("failed to delete detail info");
                        }
                    }
                    else{
                        throw new NotAcceptableHttpException("failed to delete user");
                    }
                }
            }
            else {
                //删除创建失败的用户的详细信息
                if($this->removeAttributeToMongoDB(['_id' => $detail_id])){
                    return false;
                } else{
                    throw new NotAcceptableHttpException("failed to delete detail info");
                }

            }

        } else {
            return false;
        }
    }
}