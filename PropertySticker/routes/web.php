<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('compact-table');
});

Route::get('/test','DataController@createData');

Route::get('/test2','DataController@test');

Route::get('/api/get_property', 'ApiController@reponse_property');

Route::get('/api/get_check', 'ApiController@reponse_check');