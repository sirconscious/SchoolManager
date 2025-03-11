<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function ExamesListe(){
        return view('Pages.Teacher.Exames') ;
    }
}
