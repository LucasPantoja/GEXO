<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
////////////  QUESTIONS ROUTES //////////////

Route::get('/', 'QuestionController@About');
Route::get('/question/create', 'QuestionController@createQuestion');
Route::get('/question/show', 'QuestionController@Show');
Route::get('/question/info/{id}', 'QuestionController@Info');
Route::get('/question/image/{id}', 'QuestionController@Image');

Route::post('/question', 'QuestionController@saveQuestion');

////////////  ALTERNATIVES ROUTES //////////////

Route::post('/alternatives', 'AlternativeController@saveAlternative');

////////////  COMMENTS ROUTES //////////////

Route::post('/comments', 'CommentController@postComment');

////////////  FIELDS ROUTES //////////////

Route::get('/field/create', 'FieldController@createField');
Route::get('/field/show', 'FieldController@Show');

Route::post('/field', 'FieldController@saveField');

////////////  USERS AND AUTH ROUTES //////////////


Auth::routes();
Route::get('auth/logout', 'Auth\LoginController@logout');
Route::get('/home', 'UserController@Home');
Route::get('/visitor/{id}', 'UserController@Visitor');
Route::get('/rank', 'UserController@Rank');
Route::get('/upgrade', 'UserController@Upgrade');

Route::post('/pointing', 'UserController@Pointing');
Route::post('/upaccount', 'UserController@UpAccount');


////////////  LABORATORY ROUTES //////////////

Route::get('/lab/create', 'LabController@createLab');
Route::post('/lab/exec', 'LabController@execLab');
Route::get('/lab/show', 'LabController@showLab');
Route::get('/lab/result', 'LabController@Result');
Route::get('/lab/printshow', 'LabController@PrintShow');
Route::get('/lab/printresult', 'LabController@PrintResult');

////////////  SOCIAL ROUTES //////////////

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');









