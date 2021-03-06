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
    return view('layouts.index');
})->name('frontend.index');

Route::get('/login', 'Auth\AuthController@index')->name('auth.home');
Route::post('/login', 'Auth\AuthController@login')->name('auth.login');

//student login Route
// Route::post('/student/login', 'Auth\AuthController@studentLogin')->name('student.login');
// //Teacher login Route
// Route::post('/lecturer/login', 'Auth\AuthController@teacherLogin')->name('teacher.login');

Route::post('/logout', 'Auth\AuthController@logout')->name('auth.logout');
Route::group(['middleware' => 'custom.auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('user.dashboard');
    Route::get('/project', 'ProjectController@index')->name('student.project.index');
    Route::get('/members', 'ProjectController@projectMembers')->name('project.members');

    Route::get('/members/student/{id}', 'ProjectController@projectMemberStudent')->name('project.member.student');
    Route::get('/project/student-upload', 'ProjectController@upload')->name('student.project.upload');
    Route::post('/project/file', 'ProjectController@projectFile')->name('student.project.file');
    Route::get('/file-download/{id}', 'ProjectController@fileDownload')->name('student.file.download');


    // Project Topics
    Route::get('/topics', 'ProjectTopicsController@index')->name('project.topics.index');
    Route::get('/project-topic', 'ProjectTopicsController@submitProjectTopic')->name('project.topic.upload');
    Route::post('/student-project-topic', 'ProjectTopicsController@projectTopic')->name('student.project.submit');
    Route::get('/topics/show/{show}', 'ProjectTopicsController@showProject')->name('project.topics.show');

    //Project Resources
    Route::get('/resources', 'ProjectResourcesController@index')->name('project.resources.index');
    Route::get('/resources/show', 'ProjectResourcesController@showResources')->name('project.resources.show');

    // Events
    Route::get('/events', 'EventController@index')->name('events.index');

    // User Profile
    Route::get('/profile', 'ProfileController@index')->name('user.profile');
    Route::post('/profile-about', 'ProfileController@updateAbout')->name('user.profile.about');
    Route::post('/profile-avatar', 'ProfileController@uploadAvatar')->name('user.profile.avatar');


    // Lecturer Routes
    Route::get('/group', 'Lecturer\GroupController@index')->name('lecturer.groups');
    Route::get('/group/show/{id}', 'Lecturer\GroupController@show')->name('lecturer.groups.show');

    // project topics
    Route::get('/project-upload', 'Lecturer\ProjectController@index')->name('lecturer.project.index');
    Route::post('/project-topic-upload', 'Lecturer\ProjectController@projectTopic')->name('lecturer.project.upload');
    Route::get('/project-show-topics', 'Lecturer\ProjectController@approveTopics')->name('lecturer.project.approve.show');
    Route::post('/project-approve-topics', 'Lecturer\ProjectController@approve')->name('lecturer.project.approve.update');
    Route::post('/project-reject-topics', 'Lecturer\ProjectController@reject')->name('lecturer.project.reject');

    //Comments
    Route::post('/comments/post', 'CommentsController@save')->name('comments.save');
    Route::post('/comments/edit/{id}', 'CommentsController@edit')->name('comments.edit');
    Route::get('/comments/show', 'CommentsController@comments')->name('comments.show');
    Route::get('/comments/download/{file}', 'CommentsController@commentFileDownload')->name('comments.download.file');
});





Route::group(['prefix' => 'admin'], function () {
    Route::group([
        'middleware' => ['custom.auth', 'admin']
    ], function () {
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
        // Schools Routes
        Route::resource('/schools', 'Admin\SchoolsController');
        Route::resource('/departments', 'Admin\DepartmentsController');
        Route::resource('/programs', 'Admin\ProgramsController');
        //Project Routes
        Route::resource('/project', 'Admin\ProjectController');
        Route::group(['prefix' => 'topic'], function () {
            Route::get('/project-topics/{id}', 'Admin\ProjectController@topics')->name('project.topics');
            Route::get('/project-approve/{id}', 'Admin\ProjectController@topicsToApprove')->name('project.topics.approve');
            Route::post('/unapprove', 'Admin\ProjectController@unapprove')->name('project.unapprove');
            Route::post('/approve', 'Admin\ProjectController@approve')->name('project.approve');

            Route::get('/assign-project', 'Admin\ProjectController@assignIndex')->name('project.assign.index');
            Route::get('/assign-topic/{name}', 'Admin\ProjectController@assignTopics')->name('project.assign.show');
            Route::post('/assign-topic/{id}', 'Admin\ProjectController@assignTopicToStudent')->name('project.assign.topic');
            Route::get('/topics-assigned/{id}', 'Admin\ProjectController@showStudentsAssignedTopic')->name('project.assigned.students');
            Route::post('/topics-remove-topic', 'Admin\ProjectController@studentRemoveTopicAssigned')->name('project.remove.student.topic');
        });

        // Assign Supervisors to students
        Route::group(['prefix' => 'assign'], function () {
            Route::get('/index', 'Admin\AssignSupervisor@index')->name('assign.index');
            Route::get('/assign-category/{name}', 'Admin\AssignSupervisor@assignCategory')->name('assign.category');
            Route::get('/show-assign/{show}', 'Admin\AssignSupervisor@assignStudents')->name('assign.show');
            Route::get('/show-group/{id}', 'Admin\AssignSupervisor@assignGroups')->name('assign.show.groups');
            Route::get('/show-unassign/{show}', 'Admin\AssignSupervisor@unAssign')->name('assign.unassign');
            Route::post('/assign', 'Admin\AssignSupervisor@assignSupervisor')->name('assign.assignSupervisor');
            Route::delete('/unassign/{id}', 'Admin\AssignSupervisor@unassignSupervisor')->name('unassign.supervisor');

            Route::post('/auto-grouping', 'Admin\AssignSupervisor@autoGrouping')->name('auto.group');
            Route::post('/group-supervisor', 'Admin\AssignSupervisor@groupAssignSupervisor')->name('group.assign.supervisor');
            Route::post('/group-delete-supervisor', 'Admin\AssignSupervisor@groupDeleteSupervisor')->name('group.delete.supervisor');
            Route::post('/group-add-student', 'Admin\AssignSupervisor@groupAddStudent')->name('group.add.student');
            Route::post('/group-delete-student', 'Admin\AssignSupervisor@groupDeleteStudent')->name('group.delete.student');
            Route::post('/group-assign-topic', 'Admin\AssignSupervisor@groupAssignTopic')->name('group.assign.topic');
        });
    });
});
