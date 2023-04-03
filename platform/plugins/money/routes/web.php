<?php

Route::group(['namespace' => 'Botble\Money\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::get('/top-up', 'MoneyController@topUp')->name('top_up');
    Route::get('/withdraw', 'MoneyController@withdraw')->name('withdraw');
    Route::get('/top-up-record', 'MoneyController@topUpRecord')->name('top_up_record');
    Route::get('/withdraw-record', 'MoneyController@withdrawRecord')->name('withdraw_record');

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'money', 'as' => 'money.'], function () {
            Route::resource('', 'MoneyController')->parameters(['' => 'money']);
            Route::post('/top-up', 'MoneyController@saveTopUp')->name('save_top_up');
            Route::post('/withdraw', 'MoneyController@saveWithdraw')->name('save_withdraw');
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'MoneyController@deletes',
                'permission' => 'money.destroy',
            ]);
        });
    });

});
