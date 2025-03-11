<?php

namespace App\Http\Controllers;

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
        ]) ; 
        Courses::create($formFields) ;
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
        $courses->update($formFields) ;
        return to_route('admin.CoursesListe')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $courses)
    {
        $courses->delete(); 
        return back()->with('success', 'Course deleted successfully.');
    }
}
