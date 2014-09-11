<?php

use common\models\systemInfo;

$this->title = '系统信息';

?>
<div id="systemInfo">


    <?php

    $sysInfo = new systemInfo();
    /* @var $panel yii\debug\panels\ConfigPanel */
    //$extensions = $sysInfo->getExtensions();
    $eee = $sysInfo->save();

    $sysInfo->load($eee);
    //dump($extensions);
    //dump($eee);
    //die();
    ?>
    <h1>Configuration</h1>

    <?php
    echo $this->render('table', [
        'caption' => 'Application Configuration',
        'values' => [
            'Yii Version' => $sysInfo->data['application']['yii'],
            'Application Name' => $sysInfo->data['application']['name'],
            'Environment' => $sysInfo->data['application']['env'],
            'Debug Mode' => $sysInfo->data['application']['debug'] ? 'Yes' : 'No',
        ],
    ]);

    //if (!empty($extensions)) {
    //    echo $this->render('table', [
    //        'caption' => 'Installed Extensions',
    //        'values' => $extensions,
    //    ]);
    //}
    //
    echo $this->render('table', [
        'caption' => 'PHP Configuration',
        'values' => [
            'PHP Version' => $sysInfo->data['php']['version'],
            'Xdebug' => $sysInfo->data['php']['xdebug'] ? 'Enabled' : 'Disabled',
            'APC' => $sysInfo->data['php']['apc'] ? 'Enabled' : 'Disabled',
            'Memcache' => $sysInfo->data['php']['memcache'] ? 'Enabled' : 'Disabled',
        ],
    ]);
    ?>


</div>

