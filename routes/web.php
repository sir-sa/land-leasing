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
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/contact', function () {
    return view('contact');
});
 Route::get('/dashboard', function () {
     return view('dashboard');
 });
 Route::get('/border', function () {
     return view('border');
 });
 Route::get('/cards', function () {
     return view('cards');
 });
 Route::get('/charts', function () {
     return view('charts');
 });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('/', 'WelcomeController');
Route::namespace('Admin')->prefix('adminn')->name('adminn.')->middleware('can:manage-user')->group(function(){
    Route::resource('/users', 'UsersController',['except'=>['show','create','store']]);
    Route::resource('/blog', 'BlogsController');
    Route::resource('/posts', 'PostsController');
    Route::resource('/testimonial', 'TestimonialsController');
    Route::resource('/video', 'VideosController');
    Route::resource('/coverimage', 'CoverImageController');
    Route::resource('/season', 'SeasonalController');
});
