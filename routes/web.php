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
    return view('layouts.main');
});

Route::get('/login', 'Auth\AuthController@index')->name('auth.home');
Route::post('/login', 'Auth\AuthController@login')->name('auth.login');

//student login Route
// Route::post('/student/login', 'Auth\AuthController@studentLogin')->name('student.login');
// //Teacher login Route
// Route::post('/lecturer/login', 'Auth\AuthController@teacherLogin')->name('teacher.login');

Route::post('/logout', 'Auth\AuthController@logout')->name('auth.logout');
Route::group(['middleware' => 'custom.auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('user.dashboard');
    Route::get('/project', 'ProjectController@index')->name('project.index');
    Route::get('/project-members', 'ProjectController@projectMembers')->name('project.members');
    // Takes a parameter
    Route::get('/project-member/student', 'ProjectController@projectMemberStudent')->name('project.member.student');
    Route::get('/project-upload', 'ProjectController@upload')->name('project.upload');

    // Project Topics
    Route::get('/project-topics', 'ProjectTopicsController@index')->name('project.topics.index');
    // Takes a parameter
    Route::get('/project-topics/show', 'ProjectTopicsController@showProject')->name('project.topics.show');

    //Project Resources
    Route::get('/project-resources', 'ProjectResourcesController@index')->name('project.resources.index');
    // Takes a parameter
    Route::get('/project-resources/show', 'ProjectResourcesController@showResources')->name('project.resources.show');


});

Route::group(['prefix' => 'admin'], function () {
    Route::group([
        'middleware' => ['custom.auth','admin']], function () {
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    });
});