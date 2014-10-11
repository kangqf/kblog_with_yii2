<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\models;


use Yii;
use yii\base\Component;

/**
 * Debugger panel that collects and displays application configuration and environment.
 *
 * @property array $extensions This property is read-only.
 * @property array $phpInfo This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class systemInfo extends Component
{
    public $data;

    public function load($data)
    {
        $this->data = $data;
    }


    /**
     * Returns data about extensions
     *
     * @return array
     */
    public function getExtensions()
    {
       // $data = [];
        foreach ($this->data['extensions'] as $extension) {
            $data[$extension['name']] = $extension['version'];
        }

        return $data;
    }

    /**
     * Returns the BODY contents of the phpinfo() output
     *
     * @return array
     */
    public function getPhpInfo()
    {
        ob_start();
        phpinfo();
        $pinfo = ob_get_contents();
        ob_end_clean();
        $phpinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo);
        $phpinfo = str_replace('<table ', '<table class="table table-condensed table-bordered table-striped table-hover config-php-info-table"', $phpinfo);

        return $phpinfo;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        return [
            'application' => [
                'yii' => Yii::getVersion(),
                'name' => Yii::$app->name,
                'env' => YII_ENV,
                'debug' => YII_DEBUG,
            ],
            'php' => [
                'version' => PHP_VERSION,
                'xdebug' => extension_loaded('xdebug'),
                'apc' => extension_loaded('apc'),
                'memcache' => extension_loaded('memcache'),
                'phpApiName' =>$this->getPhpApiName(),
                'safeMode' => $this->getSafeMode(),
                'gdVersion' => $this->getGdVersion(),
                'zendVersion' => $this->getZendVersion(),
                'memoryUsage' => $this->getMemoryUsage(),
            ],
            'server' => [
                'system' => $this->getSystemInfo(),
                'mysqlVersion' => $this->getMysqlVersion(),
                'server' =>  $this->getServerSoftwares(),
                'httpVersion' => $this->getHttpVersion(),
                'serverIp' => $this->getServerName(),
                'clientIp' => $this->getClientIp(),
                'serverDomainName' => $this->getServerDomainName(),
                'serverCpu' => $this->getServerCpu(),
                'serverPort' => $this->getServerPort(),
                'documentRoot' => $this->getDocumentRoot(),
                'maxExecutionTime' => $this->getMaxExecutionTime(),
                'serverFileUpload' => $this->getServerFileUpload(),
                'registerGlobals' => $this->getRegisterGlobals(),
                'serverLanguage' => $this->getServerLanguage(),

            ],

            'extensions' => Yii::$app->extensions,
        ];
    }



    /**
     * 获取服务器时间
     * @access public
     * @return string
     */
    public function getServerTime()
    {
        return date('Y-m-d　H:i:s');
    }

    /**
     * 获取服务器IP
     * 例如：'serverIp' => '127.0.0.1'
     * @access public
     * @return string
     */
    public function getServerName()
    {
       return GetHostByName($_SERVER['SERVER_NAME']);
    }

    /**
     * 获取服务器域名
     * 例如： 'serverDomainName' => 'www.aaa.com'
     * @access public
     * @return string
     */
    public function getServerDomainName()
    {
        return $_SERVER["HTTP_HOST"];
    }

    /**
     * 获取客户端IP
     * 例如：'clientIp' => '127.0.0.1'
     * @access public
     * @return string
     */
    public function getClientIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * 获取服务器CPU数量
     * 例如： 'serverCpu' => 'Intel64 Family 6 Model 58 Stepping 9, GenuineIntel'
     * @access public
     * @return string
     */
    public function getServerCpu()
    {
        return $_SERVER['PROCESSOR_IDENTIFIER'];
    }


    /**
     * 获取服务器Web端口
     * 例如：'serverPort' => '80'
     * @access public
     * @return string
     */
    public function getServerPort()
    {
        return $_SERVER['SERVER_PORT'];
    }

    /**
     * 获取服务器Web端口
     * 例如：'serverLanguage' => 'zh-CN,zh;q=0.8,en-US;q=0.6,en;q=0.4'
     * @access public
     * @return string
     */
    public function getServerLanguage()
    {
        return $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }



    /**
     * 获取zend版本
     * 例如：'zendVersion' => '2.5.0'
     * @access public
     * @return string
     */
    public function getZendVersion()
    {
        return Zend_Version();
    }

    /**
     * 获取Php api 名字
     * 例如：'phpApiName' => 'cgi-fcgi'
     * @access public
     * @return string
     */
    public function getPhpApiName()
    {
        return php_sapi_name();
    }

    /**
     * 获取服务器系统信息
     * 例如：Windows NT THINK-PC 6.1 build 7601 (Windows 7 Ultimate Edition Service Pack 1) i586
     * @access public
     * @return string
     */
    public function getSystemInfo()
    {
        return php_uname();
    }

    /**
     * 获取服务器解译引擎
     * 例如：Apache/2.2.8 (Win32) PHP/5.2.6
     * @access public
     * @return string
     */
    public function getServerSoftwares()
    {
        return $_SERVER['SERVER_SOFTWARE'];
    }

    /**
     * 获取Mysql版本号
     * @access public
     * @return string
     */
    public function getMysqlVersion()
    {
        $con = mysql_connect("121.40.120.73", "root", "kqf911");
        //dump($con);die();
        return mysql_get_server_info($con);
    }

    /**
     * 获取Http版本号
     * @access public
     * @return string
     */
    public function getHttpVersion()
    {
        return $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * 获取网站根目录
     * @access public
     * @return string
     */
    public function getDocumentRoot()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    /**
     * 获取PHP脚本最大执行时间
     * @access public
     * @return string
     */
    public function getMaxExecutionTime()
    {
        return ini_get('max_execution_time').' Seconds';
    }

    /**
     * 获取服务器允许文件上传的大小
     * @access public
     * @return string
     */
    public function getServerFileUpload()
    {
        if (@ini_get('file_uploads')) {
            return '允许 '.ini_get('upload_max_filesize');
        } else {
            return '<font color="red">禁止</font>';
        }
    }

    /**
     * 获取全局变量 register_globals的设置信息 On/Off
     * @access public
     * @return string
     */
    public function getRegisterGlobals()
    {
        return $this->getPhpCfg('register_globals');
    }

    /**
     * 获取安全模式 safe_mode的设置信息 On/Off
     * @access public
     * @return string
     */
    public function getSafeMode()
    {
        return $this->getPhpCfg('safe_mode');
    }

    /**
     * 获取Gd库的版本号
     * @access public
     * @return string
     */
    public function getGdVersion()
    {
        if(function_exists('gd_info')){
            $GDArray = gd_info();
            $gd_version_number = $GDArray['GD Version'] ? '版本：'.$GDArray['GD Version'] : '不支持';
        }else{
            $gd_version_number = '不支持';
        }
        return $gd_version_number;
    }

    /**
     * 获取内存占用率
     * @access public
     * @return string
     */
    public function getMemoryUsage()
    {
        return $this->ConversionDataUnit(memory_get_usage());
    }

    /**
     * 对数据单位 (字节)进行换算
     * @access private
     * @param $size
     * @return string
     */
    private function ConversionDataUnit($size)
    {
        $kb = 1024;       // Kilobyte
        $mb = 1024 * $kb; // Megabyte
        $gb = 1024 * $mb; // Gigabyte
        $tb = 1024 * $gb; // Terabyte
        //round() 对浮点数进行四舍五入
        if($size < $kb) {
            return $size.' Byte';
        }
        else if($size < $mb) {
            return round($size/$kb,2).' KB';
        }
        else if($size < $gb) {
            return round($size/$mb,2).' MB';
        }
        else if($size < $tb) {
            return round($size/$gb,2).' GB';
        }
        else {
            return round($size/$tb,2).' TB';
        }
    }

    /**
     * 获取PHP配置文件 (php.ini)的值
     * @param string $val 值
     * @access private
     * @return string
     */
    private function getPhpCfg($val)
    {
        switch($result = get_cfg_var($val)) {
            case 0:
                return '关闭';
                break;
            case 1:
                return '打开';
                break;
            default:
                return $result;
                break;
        }
    }



}
