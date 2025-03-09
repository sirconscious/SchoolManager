<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Pages.Todolist' , compact('tasks')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task =  $request->input('task') ; 
        $user_id = auth()->user()->id ;
        $task = Todolist::create([
            "body" => $task, 
            "status"=> "pending" ,
            "users_id" => $user_id
        ]) ;
        
        return back()->with('success', 'Task added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Todolist $todolist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todolist $todolist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todolist $todolist)
    {
        $Newstauts = $todolist->status == "pending" ? "completed" : "pending" ;
        $todolist->update([
            "status" => $Newstauts
        ]) ;
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todolist $todolist)
    {
        $todolist->delete() ;
        return back()->with('success', 'Task deleted successfully');
    }
}
