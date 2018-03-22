<?php

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

//Root of lumen
$app->get('/auth/login', function () use ($app) {
    return ($app->version().' powered by jesusleira');
});

//Function to generate a random Key
$app->get('/key', function() {
        $key = "message.categoriaguardada";

	return trans($key);
});

//Route to login users
    $app->post('api/auth/login', 'AuthController@login');
$app->get('api/empresasactivas','ExampleController@empresasactivas');


//GRoup with protection to login users.
$app->group(['middleware' => 'auth:api'], function($app)
{
    $app->get('/test', function() {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    });
    $app->get('/api/mydata', 'AuthController@mydata');
    $app->post('/api-material-guardarcategoria', 'CategoriaController@nuevacategoria');    
    $app->post('/api-material-editarcategoria', 'CategoriaController@editarcategoria');    
    $app->get('/api-material-categorias', 'CategoriaController@categorias');
//   $app->get('/api-material-categorias', 'CategoriaController@prueba');

});

