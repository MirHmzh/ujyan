<?php



Route::group(['middleware' => ['sentry.auth']], function()
{
	Route::get('/userg', array('as' => 'home', 'uses' => 'HomeController@user'));
	Route::get('/', 'HomeController@showsuccess');
	Route::post('/pdf', 'HomeController@printpdf');
	Route::get('/pdf', 'HomeController@showsuccess');
	Route::get('/pdf/{$id}', 'HomeController@findpdf');
	Route::get('/soal', 'HomeController@index');
});