<?php
return [
    'accessFrontend' => [
        'type' => 2,
        'description' => '进入前台主网站',
    ],
    'accessUserData' => [
        'type' => 2,
        'description' => '访问用户数据',
    ],
    'accessBackend' => [
        'type' => 2,
        'description' => '访问后端',
    ],


    "guest" => [
        'type' => 1,
        'description' => '游客',
        'children' => [
            'accessFrontend',
        ],
    ],
    10 => [
        'type' => 1,
        'description' => '用户-10',
        'children' => [
            'guest',
            'accessUserData',
        ],
    ],
    9 => [
        'type' => 1,
        'description' => '运营商（合作伙伴）-9',
        'children' => [
            10,
            'accessBackend',
        ],
    ],
    8 => [
        'type' => 1,
        'description' => '经理（合伙人）-8',
        'children' => [
            9,
        ],
    ],
    7 => [
        'type' => 1,
        'description' => '财务-7',
        'children' => [
            10,
            'accessBackend',
        ],
    ],
    6 => [
        'type' => 1,
        'description' => '数据分析师-6',
        'children' => [
            10,
            'accessBackend',
        ],
    ],
    5 => [
        'type' => 1,
        'description' => '运营商-5',
        'children' => [
            10,
            'accessBackend',
        ],
    ],
    4 => [
        'type' => 1,
        'description' => '经理-4',
        'children' => [
            5,
        ],
    ],
    3 => [
        'type' => 1,
        'description' => '领导-3',
        'children' => [
            4,
        ],
    ],
    2 => [
        'type' => 1,
        'description' => '高级领导-2',
        'children' => [
            3,
        ],
    ],
    1 => [
        'type' => 1,
        'description' => '管理员-1',
        'children' => [
            2,
        ],
    ],
    0 => [
        'type' => 1,
        'description' => '超级管理员-0',
        'children' => [
            1,
        ],
    ],
];
