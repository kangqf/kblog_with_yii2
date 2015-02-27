<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace common\compoents;


class Qiniu extends \callmez\file\system\adapters\Qiniu
{
    /**
     * Copy a file by url
     *
     * @param $url
     * @param $path
     * @return bool
     * @internal param $newpath
     */
    public function urlCopy($url, $path)
    {
        $err = Qiniu_RS_Fetch($this->getClient(), $url, $this->bucket, $path);
        return $err === null;
    }

}