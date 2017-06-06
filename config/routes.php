<?php
use Cake\Routing\Router;

Router::plugin(
    'UsersPermissions',
    ['path' => '/users-permissions'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
