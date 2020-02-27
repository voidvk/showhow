<?php
$function_all_router = function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::post('/login', 'LoginController@login')->name('login');
        Route::get('/logout', 'LoginController@logout')->name('logout');

        Route::group(['middleware' => 'admin'], function () {
            Route::resource('authors', 'AuthorsController');
        });
    });
};
