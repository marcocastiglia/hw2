<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('startingpage');
});

Route::get('signup','App\Http\Controllers\LogController@signup_view');
Route::post('signup','App\Http\Controllers\LogController@signup_form');

Route::get('logout','App\Http\Controllers\LogController@logout');

Route::get('signin','App\Http\Controllers\LogController@signin_view');
Route::post('signin','App\Http\Controllers\LogController@signin_form');


Route::get('userpage','App\Http\Controllers\UserpageController@userpage_view');

Route::get('get_pro_gif','App\Http\Controllers\UserpageController@get_pro_gif');
Route::get('fetch_giphy/{q}','App\Http\Controllers\UserpageController@fetch_giphy');
Route::post('upload_gif','App\Http\Controllers\UserpageController@upload_gif');

Route::get('search_image_post/{query}','App\Http\Controllers\UserpageController@search_image_post');
Route::post('create_post','App\Http\Controllers\UserpageController@create_post');
Route::get('fetch_yourPosts','App\Http\Controllers\UserpageController@fetch_yourPosts');
Route::get('delete_post/{id}','App\Http\Controllers\UserpageController@delete_post');

Route::post('verify_password','App\Http\Controllers\UserpageController@verify_password');


Route::get('modify_account','App\Http\Controllers\ModifyController@modify_account_view');
Route::post('modify_account','App\Http\Controllers\ModifyController@modify_form');
Route::get('unverify_password','App\Http\Controllers\ModifyController@unverify_password');


Route::get('homepage','App\Http\Controllers\HomepageController@homepage_view');
Route::get('homepage/allPosts','App\Http\Controllers\HomepageController@fetch_allPosts');
Route::get('homepage/ingredient/{name}','App\Http\Controllers\HomepageController@fetch_postsByIngredient');
Route::get('userpage/sessionFavorite','App\Http\Controllers\HomepageController@sessionFavorite');

Route::get('homepage/getUserInfo','App\Http\Controllers\HomepageController@getUserInfo');
Route::get('homepage/getProGif','App\Http\Controllers\HomepageController@get_pro_gif');

Route::get('homepage/like/{type}/{rec_id}','App\Http\Controllers\HomepageController@set_unset_like');
Route::get('homepage/favorite/{type}/{rec_id}','App\Http\Controllers\HomepageController@set_unset_fav');

Route::post('homepage/publish_comment/{rec_id}','App\Http\Controllers\HomepageController@publish_comment');
Route::get('homepage/allComments/{rec_id}','App\Http\Controllers\HomepageController@fetch_allComments');
Route::get('homepage/delete_comment/{comment_id}/{rec_id}','App\Http\Controllers\HomepageController@delete_comment');



