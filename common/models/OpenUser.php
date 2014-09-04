<?php

namespace common\models;

use Yii;

//第三方用户信息提取类
class OpenUser
{
    public $openId;
    public $avatarUrl;
    public $name;
    public $email;

    function __construct($client)
    {
        $attributes = $client->getUserAttributes();
        switch ($client->getId()) {
            case 'tencent':
                $this->openId = $client->openid;
                $this->avatarUrl = $attributes['figureurl_2'] . '.png';
                $this->name = $attributes['nickname'];
                $this->email = '';
                break;

            case 'weibo':
                $this->openId = $attributes['id'];
                $this->avatarUrl = strpos($attributes['avatar_hd'], '.jpg') ? $attributes['avatar_hd'] : $attributes['avatar_hd'] . '.jpg';
                $this->name = $attributes['name'];
                $this->email = '';
                break;

            case 'github':
                $this->openId = $attributes['id'];
                $this->avatarUrl = $attributes['avatar_url'] . '.jpg';
                $this->name = $attributes['name'];
                $this->email = $attributes['email'];
                break;

            case 'google':
                $this->openId = $attributes['id'];
                $this->avatarUrl = str_replace("?sz=50", "", $attributes['image']['url']);
                $this->name = $attributes['displayName'];
                $this->email = $attributes['emails'][0]['value'];
                break;

            default:
                $this->openId = '';
                $this->avatarUrl = '';
                $this->name = '';
                $this->email = '';
                break;

        }
    }

    public function grabImage($url = "", $filename = "", $path = "")
    {
        if ($url == "")
            $url = $this->avatarUrl;
        if ($url == "")
            return false;

        $extName = strrchr($url, "."); //获取扩展名
        $ext_arr = array(".gif", ".png", ".jpg", ".bmp");

        //判断扩展名是否为图片
        if (!in_array($extName, $ext_arr)) return false;

        if ($filename == "") {
            //我就随便将图片文件名保存为时间戳了，你可自行修改
            $filename = date('YmdHis') . md5($this->email) . $extName;
        }
        if ($path == "") {
            $path = Yii::getAlias("@webroot/avatar/");
        }
        ob_start(); //打开浏览器的缓冲区
        readfile($url); //将图片读入缓冲区，耗时较久，后期可以考虑使用异步队列
        $img = ob_get_contents(); //获取缓冲区的内容复制给变量$img
        ob_end_clean(); //关闭并清空缓冲
        $fp = @fopen($path . $filename, "a"); //将文件绑定到流
        fwrite($fp, $img); //写入文件
        fclose($fp); //关闭文件指针
        return $filename;
    }
}

?>
