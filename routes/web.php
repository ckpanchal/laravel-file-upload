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

Route::get('/', function () {
    return redirect('document');
});

Route::resource('document', 'DocumentController');
Route::post('update-document/{id}', ['as' => 'update-document', 'uses' => 'DocumentController@update']);