<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnoceController;
use App\Http\Controllers\CoefController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EmploieController;
use App\Http\Controllers\ExamesController;
use App\Http\Controllers\ExamRecordsController;
use App\Http\Controllers\StudentsController;
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

// Public routes (no auth middleware)
Route::get('login', [UserController::class, 'loginShow'])->name("user.login.show");
Route::post('login', [UserController::class, 'login'])->name("user.login");

// Group all routes under the 'auth' middleware
Route::middleware('auth')->group(function () {
    // User routes
    Route::resource("user", UserController::class);
    Route::get('logout', [UserController::class, 'logout'])->name("user.logout");

    // Admin routes
    Route::get('adminDashbored', [UserController::class, 'adminLayout'])->name("admin.dashbored");
    Route::post("addStudent", [AdminController::class, 'storeStudent'])->name("admin.addStudent");
    Route::get('studentList', [AdminController::class, 'studentList'])->name("admin.studentList");
    Route::get('editStudent/{user}', [AdminController::class, 'editStudent'])->name("admin.editStudent");
    Route::post('updateStudent/{user}', [AdminController::class, 'updateStudent'])->name("admin.updateStudent");

    // Teacher routes
    Route::get('teacherList', [AdminController::class, 'teacherList'])->name("admin.teacherList");
    Route::get('addTeacher', [AdminController::class, 'addTeacher'])->name("admin.addTeacher");
    Route::post('storeTeacher', [AdminController::class, 'storeTeacher'])->name("admin.storeTeacher");
    Route::get('editTeacher/{user}', [AdminController::class, 'editTeacher'])->name("admin.editTeacher");
    Route::post('updateTeacher/{user}', [AdminController::class, 'updateTeacher'])->name("admin.updateTeacher");

    // Graphs route
    Route::get('Graphs', [AdminController::class, 'Graphs'])->name("admin.Graphs");

    // Todos routes
    Route::resource('todolist', TodolistController::class);

    // Emploie routes
    Route::get('Emploie', [AdminController::class, 'AddEmploie'])->name("admin.Emploie");
    Route::post('StoreEmploie', [AdminController::class, 'StoreEmpLoie'])->name("admin.StoreEmploie");

    // Annoncements routes
    Route::get("Annoncements", [AdminController::class, 'Annoncements'])->name("admin.Annoncements");
    Route::get("AddAnnoncements", [AnnoceController::class, 'create'])->name("anonnce.create");
    Route::post("storeAnnoncements", [AnnoceController::class, 'store'])->name("anonnce.store");
    Route::delete("deleteAnnoncements/{annoce}", [AnnoceController::class, 'destroy'])->name("anonnce.destroy");
    Route::get("editAnnoncements/{annoce}", [AnnoceController::class, 'edit'])->name("anonnce.edit");
    Route::put("updateAnnoncements/{annoce}", [AnnoceController::class, 'update'])->name("anonnce.update");

    // Courses routes
    Route::get("coursesListe", [AdminController::class, "CoursesListe"])->name("admin.CoursesListe");
    Route::delete("deleteCourse/{courses}", [CoursesController::class, "destroy"])->name("course.destroy");
    Route::get("addCourse", [CoursesController::class, "create"])->name("course.create");
    Route::post("storeCourse", [CoursesController::class, "store"])->name("course.store");
    Route::get("editCourse/{courses}", [CoursesController::class, "edit"])->name("course.edit");
    Route::put("updateCourse/{courses}", [CoursesController::class, "update"])->name("course.update");

    // Exames routes
    Route::get("examesListe", [ExamesController::class, "index"])->name("exame.index");
    Route::get("createExame", [ExamesController::class, "create"])->name("exame.create");
    Route::post("storeExame", [ExamesController::class, "store"])->name("exame.store");
    Route::delete("deleteExame/{exames}", [ExamesController::class, "destroy"])->name("exame.destroy");
    Route::get("editExame/{exames}", [ExamesController::class, "edit"])->name("exame.edit");
    Route::put("updateExame/{exames}", [ExamesController::class, "update"])->name("exame.update");

    // Exam records routes
    Route::get("addexameRecord", [ExamRecordsController::class, 'create'])->name("record.create");
    Route::post("storeexameRecord", [ExamRecordsController::class, 'store'])->name("record.store");
    Route::get("studentTeacherListe", [TeachersController::class, 'studentList'])->name("teacher.studentList");
    Route::get("addexameRecordF/{user}", [ExamRecordsController::class, 'createForStudent'])->name("record.createS");
    Route::get("studentRecored/{user}", [ExamRecordsController::class, 'show'])->name("record.show");

    // Teacher emploie and annonce routes
    Route::get("Teacheremploie", [EmploieController::class, 'index'])->name("teacher.emploie");
    Route::get("TeacherAnnonce", [AnnoceController::class, 'index'])->name("teacher.anonnce");

    // Student routes
    Route::get("Main", [StudentsController::class, 'index'])->name("student.main");
    Route::get("recordsStats/{id}", [CoefController::class, 'index'])->name("student.recordsStats");
    Route::get("MyRecoreds", [StudentsController::class, 'Myrecoreds'])->name("student.MyRecoreds");
    Route::get('emploieS', [StudentsController::class, 'emploie'])->name("student.emploie");
    Route::get('AnnonceS', [StudentsController::class, 'Annocements'])->name("student.Annonce");

   
});

//apis
Route::get('/get-students/{group}', function ($group) {
    $students = User::where('role', 'student')->where('group', $group)->get();
    return Response::json($students, 200, ['Access-Control-Allow-Origin' => '*']);
});

Route::get('/get-studentByName/{name}', function ($name) {
    $students = User::where('name', 'like', "%$name%")->where('role', 'student')->get();
    return Response::json($students, 200, ['Access-Control-Allow-Origin' => '*']);
});