<?php

namespace App\Http\Controllers;

use App\Models\exam_records;
use App\Models\Exames;
use App\Models\Groupe;
use App\Models\User;
use Illuminate\Http\Request;

class ExamRecordsController extends Controller
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
        $groupes = Groupe::all(); 
        $exames = Exames::all() ;
        return view("Pages.Teacher.MakeExameRecored" , compact("groupes" , "exames")) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "exames_id" => "required",
            "users_id" => "required",
            "note" => "required",
            "comment" => "required",
        ]) ;
        exam_records::create($formFields) ;
        return back()->with('success', 'Exame record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(exam_records $exam_records)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(exam_records $exam_records)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, exam_records $exam_records)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(exam_records $exam_records)
    {
        //
    }
}
