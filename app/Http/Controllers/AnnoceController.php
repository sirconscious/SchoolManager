<?php

namespace App\Http\Controllers;

use App\Models\Annoce;
use Illuminate\Http\Request;

class AnnoceController extends Controller
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
        return view('Pages.AddAnoncment') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "title" => "required",
            "body" => "required",
            "image" => "required"
        ]) ; 
        $formFields['users_id'] = auth()->user()->id ; 
        $formFields["image"] = $request->file("image")->store("Annoce", 'public');
        Annoce::create($formFields) ;
        return to_route('admin.Annoncements')->with('success', 'Annoce added successfully.');
        // dd($formFields) ;	
    }

    /**
     * Display the specified resource.
     */
    public function show(Annoce $annoce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annoce $annoce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annoce $annoce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annoce $annoce)
    {
        //
    }
}
