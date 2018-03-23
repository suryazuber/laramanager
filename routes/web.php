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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function()
{
    Route::resource('companies','CompaniesController');

    Route::get('projects/index/{company_id?}','ProjectsController@index');
    Route::get('projects/create/{company_id?}','ProjectsController@create');
    Route::get('user/{id}', function ($id) {
    //
    })->where('id', '[0-9]+');
    Route::resource('projects','ProjectsController');

    Route::resource('roles','RolesController');
    Route::resource('tasks','TasksController');
    Route::resource('users','UsersController');
    Route::resource('comments','CommentsController');
});


