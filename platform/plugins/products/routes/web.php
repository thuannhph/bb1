<?php

Route::group(['namespace' => 'Botble\Products\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::get('/order', 'ProductsController@order')->name('order');

    Route::get('/support', 'ProductsController@support')->name('order');
    Route::get('/random-products', 'ProductsController@randomProducts')->name('random_products');

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::resource('', 'ProductsController')->parameters(['' => 'products']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'ProductsController@deletes',
                'permission' => 'products.destroy',
            ]);
        });
    });

});


