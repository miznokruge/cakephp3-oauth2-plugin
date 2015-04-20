<?php
use Cake\Routing\Router;

Router::plugin('OAuth2', ['path' => '/oauth2'], function ($routes) {
    $routes->connect('/token', [
        'controller' => 'Tokens',
        'action' => 'getToken'
    ]);
});
