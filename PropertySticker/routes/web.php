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

Route::post('/createData','DataController@createData');//createData
Route::post('/createMember', 'MemberController@createMember');//create member


Route::prefix('api')->group(function () {

	Route::post('get_property', 'ApiController@reponse_property');//API phone
	Route::post('stick', 'ApiController@reponse_check');//API2 phone
	Route::post('token_check', 'TokenController@token_check');//check token phone and web

});

Route::get('/', 'TokenController@session_check');//session_check login
Route::get('/logout', 'TokenController@logout');//logout

Route::post('/stick_web', 'ApiController@Stick_check');//Stick_check web
Route::post('/get_note_web', 'ApiController@getNote');//getNote web
Route::post('/add_note_web', 'ApiController@addNote');//addNote web

Route::post('/getpage', 'SearchController@getpage');//用ajax

Route::post('/getSearchSize','SearchController@getSearchSize');//how many result


Route::post('/upload',['as'=>'catagory_add','uses'=>'UploadController@upload_data']);

Route::post('/selc_files','UploadController@storage_files');
