<?php

return [

    '' => [
        'app_name' => APPS['weather'],
        'controller' => 'main',
        'action' => 'index',
        'name' => 'homepage',
        'perm' => 'autorized',
    ],
    
    'feedback' => [
        'app_name' => APPS['weather'],
        'controller' => 'main',
        'action' => 'feedback',
        'name' => 'feedback',
        'perm' => 'all',
    ],

    'login' => [
        'app_name' => APPS['weather'],
        'controller' => 'user',
        'action' => 'login',
        'name' => 'login',
        'perm' => 'all',
    ],
    
    'register' => [
        'app_name' => APPS['weather'],
        'controller' => 'user',
        'action' => 'register',
        'name' => 'register',
        'perm' => 'all',
    ],
    
];

?>