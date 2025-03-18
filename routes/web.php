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
    Route::get('adminDashbored', [UserController::class, 'adminLayout'])->name("admin.dashbored")->middleware('isAdmin') ;
    Route::post("addStudent", [AdminController::class, 'storeStudent'])->name("admin.addStudent")->middleware('isAdmin');
    Route::get('studentList', [AdminController::class, 'studentList'])->name("admin.studentList")->middleware('isAdmin');
    Route::get('editStudent/{user}', [AdminController::class, 'editStudent'])->name("admin.editStudent")->middleware('isAdmin');
    Route::post('updateStudent/{user}', [AdminController::class, 'updateStudent'])->name("admin.updateStudent")->middleware('isAdmin');

    // Teacher routes
    Route::get('teacherList', [AdminController::class, 'teacherList'])->name("admin.teacherList")->middleware('isAdmin');
    Route::get('addTeacher', [AdminController::class, 'addTeacher'])->name("admin.addTeacher")->middleware('isAdmin');
    Route::post('storeTeacher', [AdminController::class, 'storeTeacher'])->name("admin.storeTeacher")->middleware('isAdmin'); ;
    Route::get('editTeacher/{user}', [AdminController::class, 'editTeacher'])->name("admin.editTeacher")->middleware('isAdmin'); ;
    Route::post('updateTeacher/{user}', [AdminController::class, 'updateTeacher'])->name("admin.updateTeacher")->middleware('isAdmin'); ;

    // Graphs route
    Route::get('Graphs', [AdminController::class, 'Graphs'])->name("admin.Graphs")->middleware('isAdmin');  

    // Todos routes
    Route::resource('todolist', TodolistController::class)->middleware('isAdmin');

    // Emploie routes
    Route::get('Emploie', [AdminController::class, 'AddEmploie'])->name("admin.Emploie")->middleware("isAdmin");
    Route::post('StoreEmploie', [AdminController::class, 'StoreEmpLoie'])->name("admin.StoreEmploie")->middleware("isAdmin");

    // Annoncements routes
    Route::get("Annoncements", [AdminController::class, 'Annoncements'])->name("admin.Annoncements")->middleware("isAdmin");
    Route::get("AddAnnoncements", [AnnoceController::class, 'create'])->name("anonnce.create")->middleware("isAdmin");
    Route::post("storeAnnoncements", [AnnoceController::class, 'store'])->name("anonnce.store")->middleware("isAdmin");
    Route::delete("deleteAnnoncements/{annoce}", [AnnoceController::class, 'destroy'])->name("anonnce.destroy")->middleware("isAdmin");
    Route::get("editAnnoncements/{annoce}", [AnnoceController::class, 'edit'])->name("anonnce.edit")->middleware("isAdmin");
    Route::put("updateAnnoncements/{annoce}", [AnnoceController::class, 'update'])->name("anonnce.update")->middleware("isAdmin");

    // Courses routes
    Route::get("coursesListe", [AdminController::class, "CoursesListe"])->name("admin.CoursesListe")->middleware("isTeacher");
    Route::delete("deleteCourse/{courses}", [CoursesController::class, "destroy"])->name("course.destroy")->middleware("isTeacher");
    Route::get("addCourse", [CoursesController::class, "create"])->name("course.create")->middleware("isTeacher");
    Route::post("storeCourse", [CoursesController::class, "store"])->name("course.store")->middleware("isTeacher");
    Route::get("editCourse/{courses}", [CoursesController::class, "edit"])->name("course.edit")->middleware("isTeacher");
    Route::put("updateCourse/{courses}", [CoursesController::class, "update"])->name("course.update")->middleware("isTeacher");

    // Exames routes
    Route::get("examesListe", [ExamesController::class, "index"])->name("exame.index")->middleware("isTeacher");
    Route::get("createExame", [ExamesController::class, "create"])->name("exame.create")->middleware("isTeacher");
    Route::post("storeExame", [ExamesController::class, "store"])->name("exame.store")->middleware("isTeacher");
    Route::delete("deleteExame/{exames}", [ExamesController::class, "destroy"])->name("exame.destroy")->middleware("isTeacher");
    Route::get("editExame/{exames}", [ExamesController::class, "edit"])->name("exame.edit")->middleware("isTeacher");
    Route::put("updateExame/{exames}", [ExamesController::class, "update"])->name("exame.update")->middleware("isTeacher");

    // Exam records routes
    Route::get("addexameRecord", [ExamRecordsController::class, 'create'])->name("record.create")->middleware('isTeacher');
    Route::post("storeexameRecord", [ExamRecordsController::class, 'store'])->name("record.store")->middleware('isTeacher');
    Route::get("studentTeacherListe", [TeachersController::class, 'studentList'])->name("teacher.studentList")->middleware('isTeacher')->middleware('isTeacher');
    Route::get("addexameRecordF/{user}", [ExamRecordsController::class, 'createForStudent'])->name("record.createS")->middleware('isTeacher');
    Route::get("studentRecored/{user}", [ExamRecordsController::class, 'show'])->name("record.show")->middleware('isTeacher');

    // Teacher emploie and annonce routes
    Route::get("Teacheremploie", [EmploieController::class, 'index'])->name("teacher.emploie")->middleware('isTeacher');
    Route::get("TeacherAnnonce", [AnnoceController::class, 'index'])->name("teacher.anonnce")->middleware('isTeacher');

    // Student routes
    Route::get("Main", [StudentsController::class, 'index'])->name("student.main")->middleware('isStudent') ;
    Route::get("recordsStats/{id}", [CoefController::class, 'index'])->name("student.recordsStats")->middleware('isStudent');
    Route::get("MyRecoreds", [StudentsController::class, 'Myrecoreds'])->name("student.MyRecoreds")->middleware('isStudent');
    Route::get('emploieS', [StudentsController::class, 'emploie'])->name("student.emploie")->middleware('isStudent');
    Route::get('AnnonceS', [StudentsController::class, 'Annocements'])->name("student.Annonce")->middleware('isStudent');

   
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