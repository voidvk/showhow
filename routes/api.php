<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/csrf', function() {
    return Session::token();
});

Route::group(['namespace' => 'Events', 'prefix' => 'events'], function (){
    Route::resource('posts', 'EventPostController')->names('events.posts');
    Route::get('posts_count', 'EventPostController@count')->name('events.posts_count');
});

$groupData =[
    'namespace' => 'Events\Admin',
    'prefix' => 'admin/events'
];

Route::group($groupData,function (){
    $methods = ['index','edit','store','update','create'];
    Route::resource('categories','EventCategoriesController')->only($methods)->names('admin.events.categories');
});
