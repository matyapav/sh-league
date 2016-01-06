<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Home ...
Route::get('/', function () {
        return view('home');
});

//User routes ...

Route::get('/users', ['middleware' => ['auth'], 'uses' => 'UserController@index']);
Route::get('/users/show/{id}', ['middleware' => ['auth'], 'uses'=> 'UserController@show']);
Route::any('/users/delete/{id}', ['middleware' => ['auth','admin'], 'uses'=> 'UserController@destroy']);
Route::post('/checkNickNameAvailability', 'UserController@checkUserNicknameAvailability');
Route::post('/checkEmailAvailability', 'UserController@checkUserEmailAvailability');
Route::post('/uploadAvatar', 'UserController@uploadAvatar');
Route::post('/users/setRoles/{id}', 'UserController@setRoles');
Route::get('/users/acceptInvitation/{id}', ['middleware' => ['auth'], 'uses' => 'UserController@acceptInvitation']);
Route::get('/users/declineInvitation/{id}', ['middleware' => ['auth'], 'uses' => 'UserController@declineInvitation']);
Route::get('/users/leaveTeam/{id}', ['middleware' => ['auth'], 'uses' => 'UserController@leaveTeam']);
//Team routes ...
Route::get('/teams', ['middleware' => ['auth'], 'uses' => 'TeamController@index']);
Route::get('/teams/show/{id}', ['middleware' => ['auth'], 'uses'=> 'TeamController@show']);
Route::get('/teams/createForm', ['middleware' => ['auth'], 'uses'=> 'TeamController@create']);
Route::get('/teams/edit/{id}', ['middleware' => ['auth'], 'uses'=> 'TeamController@edit']);
Route::any('/teams/delete/{id}', ['middleware' => ['auth'], 'uses'=> 'TeamController@destroy']);
Route::any('/teams/create', ['middleware' => ['auth'], 'uses'=> 'TeamController@store']);
Route::any('/teams/update/{id}', ['middleware' => ['auth'], 'uses'=> 'TeamController@update']);
Route::get('/teams/inviteUser/{id}', ['middleware' => ['auth'], 'uses'=> 'TeamController@inviteUser']);

//League routes
Route::get('/leagues', ['middleware' => ['auth'], 'uses' => 'LeagueController@index']);
Route::get('/leagues/show/{id}', ['middleware' => ['auth'], 'uses'=> 'LeagueController@show']);
Route::get('/leagues/createForm', ['middleware' => ['auth','admin'], 'uses'=> 'LeagueController@create']);
Route::get('/leagues/edit/{id}', ['middleware' => ['auth','admin'], 'uses'=> 'LeagueController@edit']);
Route::any('/leagues/delete/{id}', ['middleware' => ['auth','admin'], 'uses'=> 'LeagueController@destroy']);
Route::any('/leagues/create', ['middleware' => ['auth','admin'], 'uses'=> 'LeagueController@store']);
Route::any('/leagues/update/{id}', ['middleware' => ['auth','admin'], 'uses'=> 'LeagueController@update']);

//Tournament routes ...
Route::get('/tournaments', ['middleware' => ['auth'], 'uses' => 'TournamentController@index']);
Route::get('/tournaments/show/{id}', ['middleware' => ['auth'], 'uses'=> 'TournamentController@show']);
Route::get('/tournaments/createForm', ['middleware' => ['auth','admin'], 'uses'=> 'TournamentController@create']);
Route::get('/tournaments/edit/{id}', ['middleware' => ['auth','admin'], 'uses'=> 'TournamentController@edit']);
Route::any('/tournaments/delete/{id}', ['middleware' => ['auth','admin'], 'uses'=> 'TournamentController@destroy']);
Route::any('/tournaments/create', ['middleware' => ['auth','admin'], 'uses'=> 'TournamentController@store']);
Route::any('/tournaments/update/{id}', ['middleware' => ['auth','admin'], 'uses'=> 'TournamentController@update']);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
