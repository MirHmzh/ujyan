<?php



Route::group(['middleware' => ['sentry.auth']], function()
{
<<<<<<< HEAD
	Route::get('/userg', array('as' => 'home', 'uses' => 'HomeController@user'));
	Route::get('/', 'HomeController@showsuccess');
	Route::post('/pdf', 'HomeController@printpdf');
	Route::get('/pdf', 'HomeController@showsuccess');
	Route::get('/pdf/{$id}', 'HomeController@findpdf');
	Route::get('/soal', 'HomeController@index');
=======
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
	Route::post('/pdf', 'HomeController@printpdf');
	Route::get('/pdf', 'HomeController@showsuccess');
	Route::get('/pdf/{$id}', 'HomeController@findpdf');
>>>>>>> 7c418c3449949bd902fa4a63587579f395846ec9
});