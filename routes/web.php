<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router){
    $router->get('tasks', ['uses' => 'TaskController@getTasks']);
    $router->get('tasks/{id}', ['uses' => 'TaskController@getTaskById']);
    $router->post('task', ['uses' => 'TaskController@setTask']);
    $router->patch('tasks/{id}', ['uses'=> 'TaskController@updateTask']);
    $router->delete('tasks/{id}', ['uses'=> 'TaskController@deleteTask']);
});