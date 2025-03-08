<?php

use App\Http\Controllers\AdminController;
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