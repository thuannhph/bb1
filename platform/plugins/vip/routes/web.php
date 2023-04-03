<?php

Route::group(['namespace' => 'Botble\Vip\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'vips', 'as' => 'vip.'], function () {
            Route::resource('', 'VipController')->parameters(['' => 'vip']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'VipController@deletes',
                'permission' => 'vip.destroy',
            ]);
        });
    });

});
