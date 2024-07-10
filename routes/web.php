<?php

use App\Http\Controllers\studentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::controller(studentController::class)->group(function(){
    Route::get('/','showhomePage')->name('home');
    Route::get('/viewStudentsList','showStudentsList')->name('ShowStudents');
    Route::get('/addStudentPage','addStudentPage')->name('addStudentPage');
    Route::post('/addNewStudent','addNewStudent')->name('addStudent');
    Route::get('/deleteUser/{id}','deleteUser')->name('deleteUser');
    Route::get('/UpdateUserInfo/{id}','UpdateUserPage')->name('UpdateUserPage');
    Route::post('/UpdateStudent/{id}','updateStudent')->name('updateStudent');
});