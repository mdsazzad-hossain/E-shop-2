<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/api', function () {
//     return view('layouts.app');
// });
Route::group(['namespace' => 'API','prifix'=>'api'], function () {
    Route::post('/login', 'LoginController@login');
    Route::post('/register', 'RegisterController@register');
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/logout', 'LoginController@logout');
        Route::get('/roles', 'LoginController@searchUser');
        Route::get('/get-role', 'RoleController@index');
        Route::post('/update-role/{id}', 'RoleController@update');
        Route::post('/remove-role/{id}', 'RoleController@destroy');
        Route::post('/addRole', 'RoleController@storeRole');
        Route::post('/addCategory', 'CategoryController@store');
        Route::get('/getCategory', 'CategoryController@index');
        Route::post('/update-category/{id}', 'CategoryController@update');
        Route::post('/hide-category/{id}', 'CategoryController@hideCat');
        Route::post('/publish-category/{id}', 'CategoryController@publish');
        Route::post('/delete/{id}', 'CategoryController@destroy');
        Route::get('/get-category', 'CategoryController@index');
        Route::get('/get-count-sub-cat/{id}', 'CategoryController@countSubCategory');
        Route::post('/store-sub-cat', 'SubCategoryController@store');
        Route::get('/get-sub-category', 'SubCategoryController@index');
        Route::post('/update-sub-cat/{id}', 'SubCategoryController@update_sub_category');
        Route::post('/publish/{id}', 'SubCategoryController@publish');
        Route::post('/hide-sub-category/{id}', 'SubCategoryController@hide_sub_category');
        Route::post('/delete-sub-category/{id}', 'SubCategoryController@destroy_sub_category');
        Route::post('/menu-store', 'MenuController@store');
        Route::post('/child-menu-store', 'MenuController@child_store');
        Route::get('/get-menu', 'MenuController@index');
        Route::get('/get-count-sub-menu/{id}', 'MenuController@countSubMenu');
        Route::post('/publish-menu/{id}', 'MenuController@publishMenu');
        Route::post('/hide-menu/{id}', 'MenuController@hideMenu');
        Route::post('/remove-menu/{id}', 'MenuController@removeMenu');
        Route::post('/update-menu/{id}', 'MenuController@updateMenu');
        Route::post('/publish-sub-menu/{id}', 'MenuController@publishSubMenu');
        Route::post('/hide-sub-menu/{id}', 'MenuController@hideSubMenu');
        Route::post('/remove-sub-menu/{id}', 'MenuController@removeSubMenu');
        Route::post('/update-sub-menu/{id}', 'MenuController@updateSubMenu');
        Route::post('/store', 'TestController@store');
    });


});




