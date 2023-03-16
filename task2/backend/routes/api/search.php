<?php
/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->group(['prefix' => 'api', 'middleware' => []], function () use ($router) {
    $router->get('/search', ['as' => 'api.search.get', 'uses' => 'SearchController@search']);
});
