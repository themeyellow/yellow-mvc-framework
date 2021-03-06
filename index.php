<?php
define('ROOT', str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]));

include_once 'vendor/autoload.php';
use App\Config\Route;

$router = new Route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// Blog Routes
$router->get('/', 'App\Controllers\BlogController@index');
$router->get('/create/blog', 'App\Controllers\BlogController@create');
$router->post('/create/blog', 'App\Controllers\BlogController@store');

$router->group('blog', function () use ($router) {
    $router->get('{slug}', 'App\Controllers\BlogController@show');
    $router->get('edit/{id}', 'App\Controllers\BlogController@edit');
    $router->post('edit', 'App\Controllers\BlogController@update');
    $router->get('delete/{id}', 'App\Controllers\BlogController@delete');
});



echo $router->action();
