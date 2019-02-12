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

//delete al last
/*
Route::get('/', function () {
    return view('admin_test');
});
*/

Route::get('/f', function () {
    return view('full-screen-table');
});

Route::get('/404', function () {
    return view('404');
});

Route::get('/register_temporarily', function () {
    return view('register_temporarily');
});

Route::get('/createData','DataController@createData');//createData
Route::post('/createMember', 'MemberController@createMember');//create member

//Route::get('/test','ApiController@test');

Route::prefix('api')->group(function () {

	Route::post('get_property', 'ApiController@reponse_property');//API
	Route::post('stick', 'ApiController@reponse_check');//API2
	Route::post('token_check', 'TokenController@token_check');//check token

});

Route::get('/', 'TokenController@session_check');//session_check login
Route::get('/logout', 'TokenController@logout');//logout

Route::post('/getpage', 'SearchController@getpage');//用ajax

Route::post('/getSearchSize','SearchController@getSearchSize');//how many result

//Route::post('/getsearch', 'SearchController@getsearch');//用ajax




