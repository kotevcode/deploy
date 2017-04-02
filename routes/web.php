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

Route::get('webhook/{rep_name}', ['as' => 'webhook', 'uses' => 'WebhookController@deploy', 'middleware' => 'auth']);
Route::post('tnirpc2b.whk', ['uses' => 'WebhookController@deploy']);
