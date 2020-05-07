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
//闭包路由
Route::get('/', function () {
    return view('welcome');
});

//文章
Route::prefix('/wen')->middleware("isLogin")->group(function(){
    Route::get("create","WenController@create");
    Route::post("store","WenController@store");
    Route::any("index","WenController@index");
    Route::get("edit/{id}","WenController@edit");
    Route::post("update/{id}","WenController@update");
    Route::get("destroy/{id}","WenController@destroy");
});
//新闻
Route::prefix('/xinwen')->middleware("isLogin")->group(function(){
    Route::get("create","XinwenController@create");
    Route::post("store","XinwenController@store");
    Route::get("index","XinwenController@index");
    Route::get("xwindex/{id}","XinwenController@xwindex");
    Route::get("addverb","XinwenController@addverb");
    Route::get("lessverb","XinwenController@lessverb");
});
//文章
Route::prefix('/alien')->middleware("isLogin")->group(function(){
    Route::get("create","AlienController@create");
    Route::post("store","AlienController@store");
    Route::any("index","AlienController@index");
    Route::get("edit/{id}","AlienController@edit");
    Route::post("update/{id}","AlienController@update");
    Route::get("destroy/{id}","AlienController@destroy");
});
//登录
Route::view("/login","login");
Route::post("/login/loginDo","LoginController@loginDo");
