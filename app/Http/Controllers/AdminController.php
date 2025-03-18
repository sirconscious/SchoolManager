<?php

namespace App\Http\Controllers;

use App\Models\Annoce;
use App\Models\Courses;
use App\Models\Groupe;
use App\Models\Todolist;
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
        $groupes = Groupe::all() ;
        $users = User::where('role' , 'student')->get() ;
        return view('Pages.StudentList' , compact('users' ,"groupes"));
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
            $user_id = auth()->user()->id ;
            $tasks = Todolist::where('users_id', $user_id)
            ->orderBy('status', 'desc')
            ->get();   
            $studentsCount = User::where('role', 'student')->count();
     
        // dd($result) ;
        return view('Pages.Graphes' , compact('result' , 'users' , 'tasks' , "studentsCount")) ;
    }
    public function AddEmploie(Groupe $groupe)
    {
        if (auth()->user()->role != 'admin') {
            return redirect()->route("user.login.show");
        } 
    
        $perPage = 1; // Number of items per page
        $currentPage = request()->query('page', 1); // Get current page from URL
        $groupes = Groupe::all();
    
        // Manually slice the array
        $groupesListe = $groupes->slice(($currentPage - 1) * $perPage, $perPage);
    
        $totalPages = ceil($groupes->count() / $perPage); // Calculate total pages
    
        return view('Pages.AddEmploie', compact('groupes', 'groupesListe', 'currentPage', 'totalPages'));
    }
    
    public function StoreEmpLoie(Request $request)
    {
        // Check if the user is an admin
        if (auth()->user()->role != 'admin') {
            return redirect()->route("user.login.show");
        }
        // dd($request) ;
        // Validate request inputs
        $formFields = $request->validate([
            "groupe_name" => "required",
            "dropzone-file" => "required"
        ]);
        // dd($formFields) ;
        // Store the uploaded file
            $formFields['emploie'] = $request->file("dropzone-file")->store("Emploies", 'public');
        
        // dd($formFields) ;
        // Update the groupe with the uploaded file path
        Groupe::where('group_name', $formFields['groupe_name'])->update([
            'emploie' => $formFields['emploie'],
        ]);
    
        return back()->with('success', 'Emploie added successfully.');
    }
    
    public function Annoncements(){
        if (auth()->user()->role != 'admin') {
            return redirect()->route("user.login.show");
        } 
        
        $perPage = 3; // Number of items per page
        $currentPage = request()->query('page', 1); // Get current page from URL
        $anoncments = Annoce::all();
        
        // Manually slice the array
        $anoncmentsListe = $anoncments->slice(($currentPage - 1) * $perPage, $perPage);
        
        $totalPages = ceil($anoncments->count() / $perPage); // Calculate total pages
        
        return view('Pages.Annoncements', compact('anoncmentsListe', 'currentPage', 'totalPages'));
    }
    public function CoursesListe(){
        // if (auth()->user()->role != 'admin' || auth()->user()->role != 'teacher') {
        //     return redirect()->route("user.login.show");
        // } 
        $courses = Courses::all() ;
        return view("Pages.Courses.CoursesListe" , compact("courses")) ;
    }
}