<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace common\compoents;


class Filesystem extends \callmez\file\system\FileSystem
{
    /**
     * Copy a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function urlCopy($path, $newpath)
    {
        return $this->adapter->urlCopy($path, $newpath);
    }
}