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

// Upload
Route::post('/upload/image/simditor', ['uses' => 'ApiController@uploadImageForSimditor', 'as' => 'api.upload.image.simditor']);
Route::post('/upload/image/editormd', ['uses' => 'ApiController@uploadImageForEditormd', 'as' => 'api.upload.image.editormd']);

Route::prefix('v1')->group(function () {

    Route::resource('configurations', 'Api\ConfigurationController')->only(['index', 'show']);
    Route::resource('fileAssets', 'Api\FileAssetController')->only(['index', 'show']);
    Route::resource('imageAssets', 'Api\ImageAssetController')->only(['index', 'show']);

});