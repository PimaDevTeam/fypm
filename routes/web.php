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
});

Route::group(['prefix' => 'admin'], function () {
    Route::group([
        'middleware' => ['custom.auth','admin']], function () {
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    });
});