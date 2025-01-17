<?php

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/test', 'MyController@index');
    Route::post('/test', 'MyController@store');
});

Route::group(['prefix' => 'v2', 'namespace' => 'App\Http\Controllers\V2'], function () {
    Route::get('/test', 'MyController@index');
    Route::post('/test', 'MyController@store');
});