<?php

namespace common\models;



class OpenUser
{
    public $openId;
    public $avatarUrl;
    public $name;
    public $email;


    function __construct($client){
        switch($client->getId())
        {
          case 'tencent':
            $attributes = $client->getUserAttributes();
            $this->openId = date('YmdHis').$client->openid;
            $this->avatarUrl = $attributes['figureurl_2'];
            $this->name = $attributes['nickname'];
            $this->email = '';
            $tmp = file_get_contents($this->avatarUrl);
            dump($tmp);
            break;

          case 'weibo':
            $attributes = $client->getUserAttributes();
            $this->openId = date('YmdHis').$attributes['id'];
            $this->avatarUrl = $attributes['avatar_hd'];
            $this->name = $attributes['name'];
            $this->email = '';
            break;

          case 'github':
            $attributes = $client->getUserAttributes();
            $this->openId = date('YmdHis').$attributes['id'];
            $this->avatarUrl = $attributes['avatar_url'];
            $this->name = $attributes['name'];
            $this->email = $attributes['email'];
            break;

          default:
            $this->openId = '';
            $this->avatarUrl = '';
            $this->name = '';
            $this->email = '';
            break;

        }


    }
    public function getClientAttributes(){



    }

    public static function grabImage($url,$filename="", $path = "@webroot/avatar/" )
    {
      	if ($url == "") return false;

        $ext=strrchr($url,"."); //获取扩展名
        $ext_arr = array(".gif",".png",".jpg",".bmp");

        //判断扩展名是否为图片
        if (!in_array($ext, $ext_arr)) return false;

        if($filename == "")
        {


      		//我就随便将图片文件名保存为时间戳了，你可自行修改
      		$filename = time().$ext;
      	}
      	ob_start(); //打开浏览器的缓冲区
      	readfile($url); //将图片读入缓冲区
      	$img = ob_get_contents(); //获取缓冲区的内容复制给变量$img
      	ob_end_clean(); //关闭并清空缓冲
      	$fp = @fopen($filename,"a"); //将文件绑定到流
      	fwrite($fp,$img); //写入文件
      	fclose($fp); //关闭文件之争
      	return $filename;
    }




}
