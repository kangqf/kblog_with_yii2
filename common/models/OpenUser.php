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
         * TODO correct if has two same email or name
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
         * TODO use open user type to find
         */
        $authUser = AuthUser::findByOpenId($this->openId);
        return $authUser ? $authUser->uid : null;
    }

    /**
     * 抓取图片
     * @return bool
     */
    public function fetchAvatar()
    {
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
        if($qiniu->urlCopy($this->avatar,$key)) {
            $this->avatar = $key;
            return true;
        }
        else {
            if($this->email){
                if($qiniu->urlCopy('http://www.gravatar.com/avatar/'. md5($this->email) . '?s=500&d=retro',md5($this->email).'.png')) {
                    $this->avatar = $key;
                    return true;
                }
                else {
                    $this->avatar = 'default';//存储gavatar失败 使用默认头像
                    return true;
                }
            }
            else {
                $this->avatar = 'default';//存使用默认头像
                return true;
            }
        }
    }

    public function createUser(){
        $user = new User(['scenario' => 'register']);
        $user->username = $this->username;
        $user->email = $this->email;
        $user->avatar = $this->avatar;
        $user->generateAuthKey();
        $user->generateAccessToken();
        if ($user->save()) {
            return $user;
        }
        else {
            return false;
        }
    }
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

    public function registerUser(){
        $this->fetchAvatar();
        $detail_id = $this->storeAttributeToMongoDB(); //将详细信息存进MongoDB
        $detail_id = $detail_id->{'$id'};
        if($detail_id){
            $user = $this->createUser();
            if($user) {
                $authUser  = $this->createAuthUser($user->getId(),$detail_id);
                if($authUser){
                    if (Yii::$app->getUser()->login($user, 3600 * 24)) {
                        return true;
                    }
                    return true;
                } else {
                    /**
                     * TODO delete User info
                     */
                    return false;
                }


            }
            else {
                /**
                 * TODO delete mongo info
                 */
                return false;
            }

        } else {
            return false;
        }
    }
}