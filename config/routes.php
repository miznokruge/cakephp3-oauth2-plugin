<?php
use Cake\Routing\Router;

Router::plugin('OAuth2', function ($routes) {
    $routes->fallbacks();
});
