<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) 
    {
         $user->delete() ;
         return redirect()->route('admin.studentList')->with('success', 'User deleted successfully.');
    } 
    public function loginShow(){
        
        return view('Pages.LoginForm');
    } 

    public function login(Request $request){
        $email = $request->email ;
        $password = $request->password ;
        $values = ['email'=>$email , 'password'=>$password] ;
        
        if (Auth::attempt($values)) {
            $request->session()->regenerate();
            return redirect()->route('admin.studentList')->with('success', 'You are now logged in.');
            // dd(auth()->user()->role); 
        }else{
            return back()->withErrors(['login_error' => 'Invalid email or password.']); 
            // dd(Auth::check()) ;
        }
    }
    public function logout(){
        Session::flush() ;
        Auth::logout();
        return redirect()->route('user.login.show')->with('success', 'You are now logged out.');
    }

    public function adminLayout(){
        if (Auth::user()->role == 'admin') {
            $groupes = Groupe::all() ;
            return view('Pages.AddStudent',compact('groupes') );
        }
        else {
            return view('Pages.LoginForm' );

        }
}
}
