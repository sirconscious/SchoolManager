<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Exames;
use App\Models\User;
use Illuminate\Http\Request;

class ExamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exames = Exames::all();
        return view("Pages.Exames.ExamesListe" , compact("exames")) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role', 'teacher')->get(); 
        $courses = Courses::all() ;
        return view("Pages.Exames.AddExame" , compact("teachers" , "courses")) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()) ;
        $formFields = $request->validate([
            "name" => "required",  
            "teachers_id" => "required",
            "type"=>"required" ,
            "courses_id" => "required",
            "duree" => "required"
        ]) ;
        Exames::create($formFields) ;
        return to_route('exame.index')->with('success', 'Exame added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exames $exames)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exames $exames)
    {
        $teachers = User::where('role', 'teacher')->get(); 
        $courses = Courses::all() ;
        return view("Pages.Exames.EditExame" , compact("exames" , "teachers" , "courses")) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exames $exames)
    {
        $formFields = $request->validate([	
            "name" => "required",  
            "teachers_id" => "required",
            "type"=>"required" ,
            "courses_id" => "required",
            "duree" => "required"
        ]) ;
        $exames->update($formFields) ;
        return to_route('exame.index')->with('success', 'Exame updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exames $exames)
    {
        $exames->delete() ;
        return back()->with('success', 'Exame deleted successfully.');
    }
}
