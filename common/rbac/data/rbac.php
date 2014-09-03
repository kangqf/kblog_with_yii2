<?php
return [
    'items' => [
        'accessFrontend' => [
            'type' => 2,
            'description' => 'Доступ к основному сайту',
        ],
        'accessUserData' => [
            'type' => 2,
            'description' => 'Доступ к данным пользователя',
        ],
        'accessBackend' => [
            'type' => 2,
            'description' => 'Доступ к бекенду',
        ],
        'guest' => [
            'type' => 1,
            'description' => 'Гость',
            'children' => [
                'accessFrontend',
            ],
        ],
        10 => [
            'type' => 1,
            'description' => 'Пользователь',
            'children' => [
                'guest',
                'accessUserData',
            ],
        ],
        9 => [
            'type' => 1,
            'description' => 'Оператор (партнер)',
            'children' => [
                10,
                'accessBackend',
            ],
        ],
        8 => [
            'type' => 1,
            'description' => 'Менеджер (партнер)',
            'children' => [
                9,
            ],
        ],
        7 => [
            'type' => 1,
            'description' => 'Финансист',
            'children' => [
                10,
                'accessBackend',
            ],
        ],
        6 => [
            'type' => 1,
            'description' => 'Аналитик',
            'children' => [
                10,
                'accessBackend',
            ],
        ],
        5 => [
            'type' => 1,
            'description' => 'Оператор',
            'children' => [
                10,
                'accessBackend',
            ],
        ],
        4 => [
            'type' => 1,
            'description' => 'Mенеджер',
            'children' => [
                5,
            ],
        ],
        3 => [
            'type' => 1,
            'description' => 'Руководство',
            'children' => [
                4,
            ],
        ],
        2 => [
            'type' => 1,
            'description' => 'Суперменеджер',
            'children' => [
                3,
            ],
        ],
        1 => [
            'type' => 1,
            'description' => 'Администратор',
            'children' => [
                2,
            ],
        ],
        0 => [
            'type' => 1,
            'description' => 'Супер-админ',
            'children' => [
                1,
            ],
            'assignments' => [
                1 => [
                    'roleName' => 0,
                ],
            ],
        ],
    ],
    'rules' => [],
];
