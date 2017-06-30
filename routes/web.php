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

Route::get('/', function () {
    return view('users.login');
});
Route::get('/login', function () {
    return view('users.login');
});

// USER ROUTES
Route::get('/register','UsersController@getRegister');
Route::post('/register','UsersController@postRegister');
Route::post('/login','UsersController@postLogin');
Route::get('/logout','UsersController@getLogout');
Route::get('/search','UsersController@searchUsers');
Route::post('/updateRel','UsersController@updateRel');
Route::get('/friendRequest','UsersController@friendRequest');
Route::get('/messages','UsersController@getMessages');
Route::get('/profile/{id}','UsersController@getProfile');
Route::get('/editProfile','UsersController@getEditProfile');
Route::post('/updateProfile','UsersController@updateProfile');

// POST ROUTES
/*Route::get('/home',['uses' => 'PostsController@getHome']);*/
Route::get('/home',['uses' => 'PostsController@getHome',
					'middleware' => 'auth'
					]);
Route::get('/posts','PostsController@getPosts');
Route::get('/profileposts/{userId}','PostsController@getProfilePosts');
Route::post('/addPost', 'PostsController@addPost');

// COMMENT ROUTES
Route::post('/addComment', 'CommentsController@addComment');