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
//    return view('welcome');
});
//
//Route::group(['namespace' => 'Events', 'prefix' => 'events'], function (){
//    Route::resource('posts', 'EventPostController')->names('events.posts');
//    Route::get('posts_count', 'EventPostController@count')->name('events.posts_count');
//});
//
////>Admin panel
//$groupData =[
//  'namespace' => 'Events\Admin',
//  'prefix' => 'admin/events'
//];
//Route::group($groupData,function (){
//    $methods = ['index','edit','store','update','create'];
//    Route::resource('categories','EventCategoriesController')->only($methods)->names('admin.events.categories');
//});
//Route::get('api/csrf', function() {
//    return Session::token();
//});
