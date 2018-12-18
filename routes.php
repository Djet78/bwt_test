<?php

/*
Reference to following example to specify routes:

return [
    'url' => [ 
        'app_name' => 'base dir of your app',
        'controller' => 'contriller name',
        'action' => 'controller method',
        'name' => 'this url unique name',
        'perm' => 'required user status',
    ],
    ...
];

'url' - i.e. 'account/login';  'account/register'; ect. Note that you shouldn't write leading and trailing '/'.
             Trlailing '/' is added automticaly.
             
'app_name' - Contain name of your app directory. Used for MVC extended classes and app views lookups.
             Your project can have multiple apps.
             This directory should be on one level with MVC directory.
             
'controller' - Controller class name for this url. 
               Your extended controller names should be of that kind: 'NameController' i.e.
               'MainController'; 'UserController'.
               'Controller' will be automaticaly added to specified name.
               
'action' - Method name of given controller class which will be called.

'name' - Unique url alias. You can reference to this url via its name. If you do so, 
         you are free to safely change your url in routes.

'perm' - Group of users allowed to this url i.e. 'guest'; 'autoraized'.

*/

// Register project routes here
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
    
    'logout' => [
        'app_name' => APPS['weather'],
        'controller' => 'user',
        'action' => 'logout',
        'name' => 'logout',
        'perm' => 'autorized',
    ],
    
];

?>