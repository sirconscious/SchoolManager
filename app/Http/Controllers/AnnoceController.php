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
        $perPage = 3; // Number of items per page
        $currentPage = request()->query('page', 1); // Get current page from URL
        $anoncments = Annoce::all();
        
        // Manually slice the array
        $anoncmentsListe = $anoncments->slice(($currentPage - 1) * $perPage, $perPage);
        
        $totalPages = ceil($anoncments->count() / $perPage); // Calculate total pages
        
        return view('Pages.Teacher.Annoncements', compact('anoncmentsListe', 'currentPage', 'totalPages'));
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
        if (auth()->user()->role != 'admin') {
            return redirect()->route("user.login.show") ;
        }
        return view("Pages.EditAnocment" , compact("annoce")) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annoce $annoce)
    {
        $formFields = $request->validate([
            "title" => "required",
            "body" => "required",
            
        ]) ;
        if ($request->hasFile("image")) {
            $formFields["image"] = $request->file("image")->store("Annoce", 'public');
        }
        $annoce->update($formFields) ; 
        return  redirect()->route('admin.Annoncements')->with('success', 'Annoce updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annoce $annoce)
    {
        $annoce->delete() ; 
        return back()->with('success', 'Annoce deleted successfully.');
    }
}
