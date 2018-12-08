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

// Route::get('/', function () {
//     return view('welcome');
// });

//Routes for the home page and the about page
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

//User authentication routes
Auth::routes();

//Routes for user's home and logout
Route::get('/home', 'HomeController@index')->name('home');
Route::get('users/logout','Auth\LoginController@userLogout')->name('user.logout');


Route::prefix('expert')->group(function(){
    
    //Expert registration route
    Route::get('/register', 'Auth\ExpertRegisterController@showExpertRegistrationForm')->name('expert.register');
    Route::post('/register', 'Auth\ExpertRegisterController@expertRegister')->name('expert.register.submit');

    //Expert authentication route
    Route::get('/login', 'Auth\ExpertLoginController@showLoginForm')->name('expert.login');
    Route::post('/login', 'Auth\ExpertLoginController@login')->name('expert.login.submit');
    Route::get('/logout','Auth\ExpertLoginController@logout')->name('expert.logout');

    //Expert Password Reset Routes   
    Route::get('password/email','Auth\ExpertForgotPasswordController@showLinkRequestForm')->name('expert.password.request');
    Route::post('password/email','Auth\ExpertForgotPasswordController@sendResetLinkEmail')->name('expert.password.email');
    Route::get('password/reset/{token}','Auth\ExpertResetPasswordController@showResetForm')->name('expert.password.reset');
    Route::post('password/reset','Auth\ExpertResetPasswordController@reset')->name('expert.password.update');

    //Expert dashboard routes
    Route::get('/', 'ExpertController@index')->name('expert.dashboard');
    Route::get('/articles', 'ExpertController@articles')->name('expert.articles');
    Route::get('/profile', 'ExpertController@profile')->name('expert.profile');

});

//Routes for the Gists and Blogs
Route::resource('gists','GistsController');
Route::resource('blogs','BlogsController');

//Routes for submitting comments and answers to blogs and gists respectively
Route::post('answers/{gist_id}',['uses'=>'AnswersController@store', 'as'=>'answers.store']);
Route::post('comments/{blog_id}',['uses'=>'CommentsController@store', 'as'=>'comments.store']);

//Routes for admin functionality
Route::get('/admin', 'OgaController@index')->name('oga.dashboard');

//Routes for threads

Route::get('/threads','ThreadsController@index')->name('threads.index');
Route::get('/threads/create','ThreadsController@create')->name('threads.create');
Route::get('/threads/{channel}/{thread}','ThreadsController@show')->name('threads.show');
Route::post('/threads/store','ThreadsController@store')->name('threads.store');
Route::get('/threads/{channel}','ThreadsController@index')->name('threads.index');
Route::post('/threads/{channel}/{thread}/replies','RepliesController@store')->name('replies.store');

Route::post('/replies/{reply}/favourites', 'FavouritesController@store');
