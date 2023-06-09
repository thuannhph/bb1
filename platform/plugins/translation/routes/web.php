<?php

Route::group(['namespace' => 'Botble\Translation\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::get('/language', 'TranslationController@language')->name('language');
    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'translations'], function () {
            Route::group(['prefix' => 'locales'], function () {
                Route::get('', [
                    'as'         => 'translations.locales',
                    'uses'       => 'TranslationController@getLocales',
                    'permission' => 'translations.edit',
                ]);

                Route::post('', [
                    'as'         => 'translations.locales.post',
                    'uses'       => 'TranslationController@postLocales',
                    'permission' => 'translations.edit',
                    'middleware' => 'preventDemo',
                ]);

                Route::delete('{locale}', [
                    'as'         => 'translations.locales.delete',
                    'uses'       => 'TranslationController@deleteLocale',
                    'permission' => 'translations.edit',
                    'middleware' => 'preventDemo',
                ]);

                Route::get('download/{locale}', [
                    'as'         => 'translations.locales.download',
                    'uses'       => 'TranslationController@downloadLocale',
                    'permission' => 'translations.edit',
                    'middleware' => 'preventDemo',
                ]);

                Route::get('ajax/available-remote-locales', [
                    'as'         => 'translations.locales.available-remote-locales',
                    'uses'       => 'TranslationController@ajaxGetAvailableRemoteLocales',
                    'permission' => 'translations.edit',
                ]);

                Route::post('ajax/download-remote-locale/{locale}', [
                    'as'         => 'translations.locales.download-remote-locale',
                    'uses'       => 'TranslationController@ajaxDownloadRemoteLocale',
                    'permission' => 'translations.edit',
                    'middleware' => 'preventDemo',
                ]);
            });

            Route::group(['prefix' => 'admin'], function () {
                Route::get('/', [
                    'as'         => 'translations.index',
                    'uses'       => 'TranslationController@getIndex',
                    'permission' => 'translations.edit',
                ]);

                Route::post('edit', [
                    'as'         => 'translations.group.edit',
                    'uses'       => 'TranslationController@update',
                    'permission' => 'translations.edit',
                ]);

                Route::post('publish', [
                    'as'         => 'translations.group.publish',
                    'uses'       => 'TranslationController@postPublish',
                    'permission' => 'translations.edit',
                    'middleware' => 'preventDemo',
                ]);

                Route::post('import', [
                    'as'         => 'translations.import',
                    'uses'       => 'TranslationController@postImport',
                    'permission' => 'translations.edit',
                ]);
            });

            Route::group(['prefix' => 'theme'], function () {
                Route::get('', [
                    'as'         => 'translations.theme-translations',
                    'uses'       => 'TranslationController@getThemeTranslations',
                    'permission' => 'translations.edit',
                ]);

                Route::post('', [
                    'as'         => 'translations.theme-translations.post',
                    'uses'       => 'TranslationController@postThemeTranslations',
                    'permission' => 'translations.edit',
                    'middleware' => 'preventDemo',
                ]);
            });
        });
    });
});
