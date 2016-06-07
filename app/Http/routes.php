<?php



Route::group(['middleware' => ['sentry.auth']], function()
{
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
	Route::post('/pdf', 'HomeController@printpdf');
	Route::get('/pdf', 'HomeController@showsuccess');
	Route::get('/pdf/{$id}', 'HomeController@findpdf');
});