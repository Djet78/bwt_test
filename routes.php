<?php

//define your apps and routes here
const WEATHER = 'weather_app';


return [

    '' => [
        'app_name' => WEATHER,
        'controller' => 'main',
        'action' => 'index',
        'name' => 'homepage',
    ],
    
    'feedback' => [
        'app_name' => WEATHER,
        'controller' => 'main',
        'action' => 'feedback',
        'name' => 'feedback',
    ],

    '/login' => [
        'app_name' => WEATHER,
        'controller' => 'user',
        'action' => 'login',
        'name' => 'login',
    ],
    
    '/register' => [
        'app_name' => WEATHER,
        'controller' => 'user',
        'action' => 'register',
        'name' => 'register',
    ],
    
];

?>