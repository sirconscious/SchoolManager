<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 
Route::resource("user" , UserController::class); 
Route::get('login' , [UserController::class , 'loginShow'])->name("user.login.show") ; 
Route::post('login' , [UserController::class , 'login'])->name("user.login") ; 
Route::get('adminDashbored' , [UserController::class , 'adminLayout'])->name("admin.dashbored") ; 
Route::get('logout' , [UserController::class , 'logout'])->name("user.logout") ; 
Route::post("addStudent" , [AdminController::class , 'storeStudent'])->name("admin.addStudent") ; 
Route::get('studentList' , [AdminController::class , 'studentList'])->name("admin.studentList") ;
Route::get('editStudent/{user}' , [AdminController::class , 'editStudent'])->name("admin.editStudent") ; 
Route::post('updateStudent/{user}' , [AdminController::class , 'updateStudent'])->name("admin.updateStudent") ; 
//teacher List route : 
Route::get('teacherList' , [AdminController::class , 'teacherList'])->name("admin.teacherList") ;
// add teacher route : 
Route::get('addTeacher' , [AdminController::class , 'addTeacher'])->name("admin.addTeacher") ;
//route to store a teacher : 
Route::post('storeTeacher' , [AdminController::class , 'storeTeacher'])->name("admin.storeTeacher") ; 
//route tot edit a teacher : 
Route::get('editTeacher/{user}' , [AdminController::class , 'editTeacher'])->name("admin.editTeacher") ; 
//route to update a teacher : 
Route::post('updateTeacher/{user}' , [AdminController::class , 'updateTeacher'])->name("admin.updateTeacher") ; 
//Graphs route : 
Route::get('Graphs' , [AdminController::class , 'Graphs'])->name("admin.Graphs") ; 
//Todos routes : 
Route::resource('todolist' , TodolistController::class) ;  
// route for emploie 
Route::get('Emploie' , [AdminController::class , 'AddEmploie'])->name("admin.Emploie") ; 
//route to store emploie 
Route::post('StoreEmploie' , [AdminController::class , 'StoreEmpLoie'])->name("admin.StoreEmploie") ;