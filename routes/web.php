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
Route::get('test', function(){
	echo 123;
});
Route::get('/', 'HomeController@index');
Route::get('/home/{id}', [
	'as'	=> 'home.gtags.index',
	'uses'	=> 'HomeController@index' 
]);
Route::get('/home', 'HomeController@index');
/* ABOUT */
Route::get('/about', 'AboutController@index');
/* 통합 게시판 */
Route::resource('articles', 'ArticlesController');
Route::get('articles/{id}/delete', [
	'as'	=> 'articles.delete',
	'uses'	=> 'ArticlesController@delete'
]);
Route::resource('boards', 'BoardsController');
/* 갤러리 */
Route::resource('galleries', 'GalleriesController');
Route::get('galleries/{id}/delete', [
	'as'	=> 'galleries.delete',
	'uses'	=> 'GalleriesController@delete'
]);

/* 아티스트 페이지 */
Route::get('artists', [
	'as'	=> 'artists.index',
	'uses'	=> 'ArtistsController@index'
]);
Route::get('artists/{id}', [
	'as'	=> 'artists.show',
	'uses'	=> 'ArtistsController@show'
]);
Route::get('artists/{id}/board', [
	'as'	=> 'artists.board',
	'uses'	=> 'ArtistsController@board'
]);
/* 아티스트 신청 페이지 */
Route::get('apply', [
	'as'	=> 'apply.index',
	'uses'	=> 'ApplyController@index'
]);
Route::post('apply', 'ApplyController@apply');

/* Contact Us */
Route::get('/contactUs', 'ContactsController@index');
Route::post('/contactUs', 'ContactsController@send');


//DB::listen(function ($query){
//	var_dump($query->sql);
//});

/* 사용자 가입 */
Route::get('auth/register',[
	'as'	=> 'users.create',
	'uses'	=> 'UsersController@create'
]);
Route::post('auth/register', [
	'as'	=> 'users.store',
	'uses'	=> 'UsersController@store'	
]);
Route::get('auth/confirm/{code}', [
	'as'	=> 'users.confirm',
	'uses'	=> 'UsersController@confirm'
]);

/* 가입 확인 요청 처리 */
Route::get('auth/confirm/{code}', [
	'as' => 'users.confirm',
	'uses' => 'UsersController@confirm',
])->where('code', '[\pL-\pN]{60}');

/* 사용자 인증 */
Route::get('auth/login', [
	'as'	=> 'sessions.create',
	'uses'	=> 'SessionsController@create'
]);
Route::post('auth/login', [
	'as'	=> 'sessions.store',
	'uses'	=> 'SessionsController@store'
]);
Route::get('auth/logout', [
	'as'	=> 'sessions.destroy',
	'uses'	=> 'SessionsController@destroy'
]);

/* 비밀번호 초기화 */
Route::get('auth/remind', [
	'as'	=> 'remind.create',
	'uses'	=> 'PasswordsController@getRemind',
]);
Route::post('auth/remind', [
	'as'	=> 'remind.store',
	'uses'	=> 'PasswordsController@postRemind',
]);
Route::get('auth/reset/{token}',[
	'as'	=> 'reset.create',
	'uses'	=> 'PasswordsController@getReset',
])->where('token', '[\pL-\pN]{64}');
Route::post('auth/reset', [
	'as'	=> 'reset.store',
	'uses'	=> 'PasswordsController@postReset',
]);

/* Social Login */
Route::get('social/{provider}', [
	'as'	=> 'social.login',
	'uses'	=> 'SocialController@execute',
]);

/* 개인정보 페이지 */
Route::get('account', [
	'as'	=> 'accounts.index',
	'uses'	=> 'AccountsController@index',
]);
Route::post('account', [
	'as'	=> 'accounts.update',
	'uses'	=> 'AccountsController@update',
]);


/* 태그 */
Route::get('tags/{slug}/articles', [
	'as'	=> 'tags.articles.index',
	'uses'	=> 'ArticlesController@index'
]);
Route::get('gtags/{slug}/galleries', [
	'as'	=> 'gtags.galleries.index',
	'uses'	=> 'GalleriesController@index' 
]);

/* 드랍존 */
Route::resource('attachments', 'AttachmentsController', ['only' => ['store', 'destroy']]);

Route::get('attachments/{file}', 'AttachmentsController@show');

/* File Manager */
Route::group(['before' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\LfmController@upload');
});


/* 댓글 */
Route::resource('comments', 'CommentsController', ['only'=>['update', 'destroy']]);
Route::resource('articles.comments', 'CommentsController', ['only'=>'store']);

/* 갤러리 댓글 */

Route::resource('gcomments', 'GcommentsController', ['only'=>['update', 'destroy']]);
Route::resource('galleries.gcomments', 'GcommentsController', ['only'=>'store']);


