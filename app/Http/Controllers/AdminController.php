<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function storeStudent(Request $request){ 
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required',
            'group' => 'required|string|max:255',
        ]);
        
        $validated['password'] = bcrypt($validated['password']) ; 
        $validated['role'] = 'student' ;
        // dd($request->all() ) ;
        User::create($validated) ;
        return redirect()->route('admin.studentList')->with('success', 'Student added successfully.');

    }
    public function updateStudent(Request $request , User $user){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
            'group' => 'required|string|max:255',
        ]);
        $user->update($validated) ;
        return redirect()->route('admin.studentList')->with('success', 'Student updated successfully.');
    }
    public function studentList(){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        }
        $users = User::where('role' , 'student')->get() ;
        return view('Pages.StudentList' , compact('users')) ;
    }
    public function editStudent(User $user){
    if (auth()->user()->role != 'admin') {
        redirect()->route("user.login.show") ;

    } 
        $groupes = Groupe::all() ;

    return view('Pages.EditStudent' , compact('user' , 'groupes')) ;
    }

    //teachers 
    public function teacherList(){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        }
        $users = User::where('role' , 'teacher')->get() ;
        return view('Pages.TeachersListe' , compact('users')) ;
    }
    //FORM view to add Teacher
    public function addTeacher(){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        } 
        return view('Pages.AddTeacher') ;
    }
    //add teacher 
    public function storeTeacher(Request $request){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required',
        ]);
        $validated['password'] = bcrypt($validated['password']) ; 
        $validated['role'] = 'teacher' ;
        // dd($validated) ;
        User::create($validated) ;
        return redirect()->route('admin.teacherList')->with('success', 'Teacher added successfully.');
    }
    //to edit teacher
    public function editTeacher(User $user){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        }
        return view('Pages.EditTeacher' , compact('user')) ;
    } 
    // to update teacher :
    public function updateTeacher(Request $request , User $user){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
        ]);
        $user->update($validated) ;
        return redirect()->route('admin.teacherList')->with('success', 'Teacher updated successfully.');
    } 
    public function Graphs(){
        if (auth()->user()->role != 'admin') {
            redirect()->route("user.login.show") ;
        } 
        $result = DB::table('users as u')
            ->join('groupes as g', 'u.group', '=', 'g.group_name')
            ->select('g.group_name', DB::raw('count(*) as count'))
            ->groupBy('g.group_name')
            ->get(); 
            $users = DB::table('users')
            ->selectRaw('COUNT(*) as user_count, DATE(created_at) as created_date')
            ->groupBy('created_date')
            ->orderBy('created_date', 'asc')
            ->get();
            
        // dd($result) ;
        return view('Pages.Graphes' , compact('result' , 'users')) ;
    }
}
