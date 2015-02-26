<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace common\models;

use MongoId;
use Yii;

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
    public $password;
    public $checkPassword;

    /**
     * @param \yii\authclient\BaseClient $client
     */
    function __construct($client)
    {
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
                $this->avatar = str_replace("?sz=50", "", $this->attributes['image']['url']);
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
//
//    public function grabImage($url = "", $filename = "", $path = "")
//    {
//        if ($url == "")
//            $url = $this->avatar;
//        if ($url == "")
//            return false;
//
//        $extName = strrchr($url, "."); //获取扩展名
//        $ext_arr = array(".gif", ".png", ".jpg", ".bmp");
//
//        //判断扩展名是否为图片
//        if (!in_array($extName, $ext_arr)) return false;
//
//        if ($filename == "") {
//            //我就随便将图片文件名保存为时间戳了，你可自行修改
//            $filename = date('YmdHis') . md5($this->email) . $extName;
//        }
//        if ($path == "") {
//            $path = Yii::getAlias("@webroot/avatar/");
//        }
//        ob_start(); //打开浏览器的缓冲区
//        readfile($url); //将图片读入缓冲区，耗时较久，后期可以考虑使用异步队列
//        $img = ob_get_contents(); //获取缓冲区的内容复制给变量$img
//        ob_end_clean(); //关闭并清空缓冲
//        $fp = @fopen($path . $filename, "a"); //将文件绑定到流
//        fwrite($fp, $img); //写入文件
//        fclose($fp); //关闭文件指针
//        return $filename;
//    }


    /**
     * 该第三方用户是否是第一次进行登录
     * @return static
     */
    public function isNewUser()
    {
        $authUser = AuthUser::findByOpenId($this->openId);
        return $authUser ? $authUser->uid : null;
    }

}