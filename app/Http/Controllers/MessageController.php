<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        // Messages will be fetched via API call in the frontend
        return view("chat");
    }
    public function api()
    {
        // Ensure user is authenticated and has a group
        // if (!auth()->check() || !auth()->user()->group) {
        //     return response()->json([], 401);
        // }
        $messages = Message::with('user')->where("groupe" , auth()->user()->group)->orderBy('created_at', 'asc')->get() ; 
        return response()->json(["data"=>$messages]);
    }
    public function store(Request $request){
        $validateData = $request->validate([
            "body"=>"required|string" , 
        ]); 

        // Ensure user is authenticated and has a group before creating message
        if (!auth()->check() || !auth()->user()->group) {
            return response()->json(['message' => 'User not authenticated or group not assigned'], 401);
        }

        $message = Message::create(
            [
                "body"=>$request->body , 
                "user_id"=>auth()->user()->id , 
                "groupe"=>auth()->user()->group // Correctly store the group value
            ]
        ) ;

        // Return the created message as JSON 
        return back() ;
        // return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
    }
}
