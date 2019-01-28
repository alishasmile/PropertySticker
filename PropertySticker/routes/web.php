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

Route::get('/404', function () {
    return view('404');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/firstLogin', function () {
    return view('firstLogin');
});

Route::get('/createData','DataController@createData');

//Route::get('/test2','DataController@test');

Route::post('/api/get_property', 'ApiController@reponse_property');//API

Route::post('/api/stick', 'ApiController@reponse_check');//API2