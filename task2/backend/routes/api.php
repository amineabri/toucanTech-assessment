<?php
/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->get('/', function() {
    return response()->json([
        'application'   => config('app.name'),
        'version'       => config('app.version'),
        'time'          => time(),
    ]);
});
// Add additional routes
require base_path('routes/api/search.php');
