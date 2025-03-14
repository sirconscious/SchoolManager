<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnoceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EmploieController;
use App\Http\Controllers\ExamesController;
use App\Http\Controllers\ExamRecordsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;


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
//route for the annoncements 
Route::get("Annoncements" , [AdminController::class , 'Annoncements'])->name("admin.Annoncements") ;  
//to add annoncements
Route::get("AddAnnoncements" , [AnnoceController::class , 'create'])->name("anonnce.create") ;
//to store annoncements
Route::post("storeAnnoncements" , [AnnoceController::class , 'store'])->name("anonnce.store") ; 
//to delete annoncements 
Route::delete("deleteAnnoncements/{annoce}" , [AnnoceController::class , 'destroy'])->name("anonnce.destroy") ;
//to edit a annoncements 
Route::get("editAnnoncements/{annoce}" , [AnnoceController::class , 'edit'])->name("anonnce.edit") ;
//to update a annocement 
Route::put("updateAnnoncements/{annoce}" , [AnnoceController::class , 'update'])->name("anonnce.update") ; 
//Routes for courser  
Route::get("coursesListe" , [AdminController::class , "CoursesListe"])->name("admin.CoursesListe") ; 
//Route to delete a course  
Route::delete("deleteCourse/{courses}" , [CoursesController::class , "destroy"])->name("course.destroy") ;
//Route to add a course 
Route::get("addCourse" , [CoursesController::class , "create"])->name("course.create") ;
//Route to store a course
Route::post("storeCourse" , [CoursesController::class , "store"])->name("course.store") ;
//Route to edit a course
Route::get("editCourse/{courses}" , [CoursesController::class , "edit"])->name("course.edit") ;
//Route to update a course
Route::put("updateCourse/{courses}" , [CoursesController::class , "update"])->name("course.update") ;
//route for the exames 
Route::get("examesListe" , [ExamesController::class , "index"])->name("exame.index") ; 
//route to create exame 
Route::get("createExame" , [ExamesController::class , "create"])->name("exame.create") ;
//route to store a exame
Route::post("storeExame" , [ExamesController::class , "store"])->name("exame.store") ;
//route to delete a exame
Route::delete("deleteExame/{exames}" , [ExamesController::class , "destroy"])->name("exame.destroy") ;
//route to edit a exame 
Route::get("editExame/{exames}" , [ExamesController::class , "edit"])->name("exame.edit") ; 
//route to update a exame
Route::put("updateExame/{exames}" , [ExamesController::class , "update"])->name("exame.update") ; 
//teacher routes : 
    //route to make an exame recored
Route::get("addexameRecord" , [ExamRecordsController::class , 'create'])->name("record.create") ; 
// route to get students based on groupe 

Route::get('/get-students/{group}', function ($group) {
    $students = User::where('role', 'student')->where('group', $group)->get();

    return Response::json($students, 200, ['Access-Control-Allow-Origin' => '*']);
});

Route::get('/get-studentByName/{name}' , function($name){
    $stundets= User::where('name' , 'like' , "%$name%")->where('role' , 'student')->get() ;
    return Response::json($stundets , 200 , ['Access-Control-Allow-Origin' => '*']) ; 
}) ;
//route to store an exame recored
Route::post("storeexameRecord" , [ExamRecordsController::class , 'store'])->name("record.store") ; 
// route student_teacher liste 
Route::get("studentTeacherListe" , [TeachersController::class , 'studentList'])->name("teacher.studentList") ; 
//route to make an exame recored for a student 
Route::get("addexameRecordF/{user}" , [ExamRecordsController::class , 'createForStudent'])->name("record.createS") ; 
//route to view student recored ; 
Route::get("studentRecored/{user}" , [ExamRecordsController::class , 'show'])->name("record.show") ;
//route to get the emploie 
Route::get("Teacheremploie" , [EmploieController::class , 'index'])->name("teacher.emploie") ;
//route to get Annonce 
Route::get("TeacherAnnonce" , [AnnoceController::class , 'index'])->name("teacher.anonnce") ;