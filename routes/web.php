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

Auth::routes();

Route::get('/', function()
{
  return redirect()->route('repos.index');
});
Route::resource('/repos', 'ReposController');

Route::any('webhook/{rep_name}', ['as' => 'webhook', 'uses' => 'WebhookController@deploy']);
Route::any('gjro034580ufkgj3.html', ['uses' => 'WebhookController@deploy']);
