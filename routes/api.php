<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'user'], function () {
    Route::get("index", 'UserController@index');

    Route::post("create", "UserController@store");

    Route::put("delete/{id}", "UserController@softDeleted");

    Route::put("edit/{id}", "UserController@edit");
});

Route::post('upload', 'UploadController@upload')->name('upload');