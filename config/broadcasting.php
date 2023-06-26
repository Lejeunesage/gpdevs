<?php

return [
    'default' => 'pusher',
    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => 'f8f211fc5d054099e7c3',
            'secret' => '4986b267df0e1dacfa06',
            'app_id' => '1559158',
            'options' => [
                'host' => '127.0.0.1',
                'port' => 6001,
                'cluster' => 'mt1',
                'useTLS' => false,
                'scheme' => 'http',
                'encrypted' => true,
            ],
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],
    ],
];
