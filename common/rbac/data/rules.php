<?php

use common\rbac\rules\NotGuestRule;
$notGuest = new NotGuestRule;
return [
    $notGuest->name => serialize($notGuest),
   // 'group' => 'O:27:"vova07\\rbac\\rules\\GroupRule":3:{s:4:"name";s:5:"group";s:9:"createdAt";N;s:9:"updatedAt";N;}',
];
