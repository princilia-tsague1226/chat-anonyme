<?php

const AVAILABLE_ROUTES = [
    'about' => [
        'controller' => 'AboutController',
        'method' => 'about'
    ],
    'message' => [
        'controller' => 'MessageController',
        'method' => 'message'
    ],
    'room' => [
        'controller' => 'RoomController',
        'method' => 'room' 
    ],
    'addRoom' => [ 
        'controller' => 'RoomController',
        'method' => 'addRoom'
    ]
];