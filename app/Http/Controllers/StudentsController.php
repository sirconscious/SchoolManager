<?php

namespace App\Http\Controllers;

use App\Models\Annoce;
use App\Models\exam_records;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
   

    public function index(){ 
        $recordes = exam_records::where('users_id' , auth()->user()->id)
                                ->orderBy('created_at', 'desc')
                                ->limit(4)
                                ->get();
        // dd($recordes) ;                      
        return  view("Pages.Students.Main" , compact('recordes') ) ;
    }
    public function Myrecoreds (){
        $recordes = exam_records::where('users_id' , auth()->user()->id)->get(); 
        return view("Pages.Students.MyRecoreds" , compact("recordes"));
    }
    public function emploie(){
        $emploie = DB::table('users')
        ->join('groupes', 'users.group', '=', 'groupes.group_name')
        ->where('users.id', auth()->user()->id)
        ->value('groupes.emploie');
            return view("Pages.Students.Emploie" , compact("emploie")) ;
    }
    public function Annocements(){
     
        $perPage = 3; // Number of items per page
        $currentPage = request()->query('page', 1); // Get current page from URL
        $anoncments = Annoce::all();
        
        // Manually slice the array
        $anoncmentsListe = $anoncments->slice(($currentPage - 1) * $perPage, $perPage);
        
        $totalPages = ceil($anoncments->count() / $perPage); // Calculate total pages
        return view("Pages.Students.Annoncements" , compact('anoncmentsListe', 'currentPage', 'totalPages')) ;
    }
}

