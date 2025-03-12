<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\User;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    // public function ExamesListe(){
    //     return view('Pages.Teacher.Exames') ;
    // }
    public function StudentList(){
        $students = User::where('role' , 'student')->get() ;
       $groupes = Groupe::all() ;
        return view('Pages.Teacher.StudentsListe' , compact('students' , 'groupes')) ;
    }
}   
