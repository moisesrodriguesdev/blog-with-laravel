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

Route::get('/', 'PostController@index')->name('post.home');
Route::get('criar/post', 'PostController@create')->name('post.create');
Route::post('criar/post', 'PostController@store')->name('post.store');
Route::get('post/{post}', 'PostController@show')->name('post.show');
Route::put('post/like', 'PostController@PostLike')->name('post.like');
Route::get('dashboard', 'DashboardController@index')->name('dashboard.home');
Route::post('post/comment', 'CommentPostController@store')->name('post.comment');
Route::post('post/{post}', 'PostController@SharePost')->name('post.share');

Route::get('email', function(){

    dd(storage_path('app/public/post/1/20150807_213928_7549_752891.jpg'));

//    return new \App\Mail\SharePost();

   Mail::send('emails.sharedpost', ['protocolo' => 'odskn'], function ($message) {
       $message->to('moisesabreurodrigues@gmail.com');
       $message->from('moises.rodrigues@unifametro.edu.br','Post');
       $message->subject('Recebemos sua solicitação.');
   });
});
