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

Route::get('/', 'dashboardcontroller@index');
Route::get('/dashboard', 'dashboardcontroller@index');
Route::post('/manage/addtest', 'questioncontroller@create');
Route::get('/test', 'dashboardcontroller@testview');
Route::get('/about', 'dashboardcontroller@about');
Route::get('/managestd',['middleware'=>['auth','admin'],'uses'=> 'studentcontroller@liststudent']);
Route::get('/managestd/allquestion', 'questioncontroller@displayquestion');
Route::post('/managestd/updatequestion', 'questioncontroller@updatequestion');
Route::get('/managestd/deletequestion/{id}', 'questioncontroller@deletequestion');
Route::get('/taketest/{num}', 'questioncontroller@displayquestionjson');
Route::get('/taketest',['middleware'=>['auth','student'],'uses'=> 'questioncontroller@displaytest']);
Route::get('/student/submittest/{userid}/{questionid}/{selectedoption}', 'questioncontroller@submittest');
Route::get('/count', 'questioncontroller@countquestion');
Route::get('/viewresult',['middleware'=>['auth','admin'],'uses'=>'questioncontroller@viewresult']);
Route::get('/view/result/{id}', 'questioncontroller@viewstudentresult');
Route::get('/search', 'questioncontroller@search');
Route::get('/statistics', 'questioncontroller@statistics');
Route::get('/ban/{type}/{id}', 'questioncontroller@ban');
Route::get('/completed', 'questioncontroller@completed');
Route::get('/logout', 'WelcomeController@logout');
Route::get('/duration', 'questioncontroller@duration');
Route::get('/addtime/{id}/{inputValue}', 'questioncontroller@addtime');
Route::get('/view/solution/{id}', 'questioncontroller@showsolution');
Route::get('/managestd/deletestudent/{id}', 'studentcontroller@deletestudent');
Route::get('/managestd/displayquestion/{id}', 'questioncontroller@questionbyid');
Route::get('/reset/{userid}','questioncontroller@resetanswer');
//Route::get('/test/{id}', 'questioncontroller@test');
Route::get('/register', 'registercontroller@index');
Route::post('/student/register', 'registercontroller@create');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
