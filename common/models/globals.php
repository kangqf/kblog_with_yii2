<?php

use yii\helpers\VarDumper;

//打印并高亮函数
function dump($target,$bool=true){
    static $i = 0;
    if($i==0){
        header('content-type:text/html;charset=utf-8');
    }
    VarDumper::dump($target, 10, true);
    $i++;
    if($bool){
       //exit;
    }else{
        echo '<br />';
    }
}

//打印并高亮函数
function p($target,$bool=true){
    static $i = 0;
    if($i==0){
        header('content-type:text/html;charset=utf-8');
    }
    echo '<pre>';
    print_r($target);
    $i++;
    if($bool){
       exit;
    }else{
        echo '<br />';
    }
}

function fire($target,$name=null){
    if (defined('FB_DEBUG')) {
//            Yii::import('application.extensions.debug.*');
            FB::warn($target, $name);
    }
}


class runtime
{
    var $StartTime = 0;
    var $StopTime = 0;

    function get_microtime()
    {
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    function start()
    {
        $this->StartTime = $this->get_microtime();
    }

    function stop()
    {
        $this->StopTime = $this->get_microtime();
    }

    function spent()
    {
        return round(($this->StopTime - $this->StartTime) * 1000, 1);
    }

}
?>
