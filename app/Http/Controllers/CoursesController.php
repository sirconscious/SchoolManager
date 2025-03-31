<?php

namespace App\Http\Controllers;

use App\Models\Coef;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Pages.Courses.AddCourse") ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "name" => "required",
            "description" => "required",
            'filename' => "required" ,
            
        ]) ;
         
            $formFields['filename'] = $request->file('filename')->store('Courses', 'public');
        $newCourse = Courses::create($formFields) ;
        $Coef = Coef::create([
            "courses_id" => $newCourse->id ,
            "coef"=> $request->coef 
        ]) ;
        return to_route('admin.CoursesListe')->with('success', 'Course added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $courses)
    {
        return view("Pages.Courses.EditCourse" , compact("courses")) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $courses)
    {
        $formFields = $request->validate([
            "name" => "required",
            "description" => "required",

        ]) ;
        if ($request->hasFile("filename")) {
            $formFields['filename'] = $request->file('filename')->store('Courses', 'public');

        }
        $courses->update($formFields) ;
        Coef::where('courses_id', $courses->id)->update(['coef' => $request->coef]);
        return to_route('admin.CoursesListe')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $courses)
    {
        Coef::where('courses_id', $courses->id)->delete();

        $courses->delete(); 
        return back()->with('success', 'Course deleted successfully.');
    }
}
