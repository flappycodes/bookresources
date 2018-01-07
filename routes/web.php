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

$app->get('/', function () use ($app) {
     return response()->json(['message' => 'People Wave: Exam Book Resources']);
});

$app->group(['prefix' => '/api/v1'], function() use ($app){
	$app->post('create/user', 'Api\V1\Authcontroller@create');

	$app->group(['prefix' => '/book'], function() use ($app){
		$app->get('/', 'Api\V1\BookResourcesController@index');
		$app->get('edit/{id}', 'Api\V1\BookResourcesController@edit');
		$app->get('search/{search}', 'Api\V1\BookResourcesController@search');

		$app->post('create', 'Api\V1\BookResourcesController@store');
		$app->post('update/{id}', 'Api\V1\BookResourcesController@update');
		$app->post('delete/{id}', 'Api\V1\BookResourcesController@delete');
		$app->post('purchase/{id}', 'Api\V1\BookResourcesController@purchase');
	});

});