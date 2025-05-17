<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylisteController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('cours')->get();
        $courses = Courses::all();
        
        // Group playlists by course
        $groupedPlaylists = $playlists->groupBy('cours.name');
        
        return view("playliste", compact("groupedPlaylists", "courses"));
    }
    public function gestionplaylist(){ 
        $videos = Playlist::all(); 
        $cours = Courses::all() ;
        return  view("GestionPlaylistes" , compact("videos" , "cours"));
    }
    public function store(Request $request)
    {
        // dd($request->all()) ; 
        
        $validated =  $request->validate([
            'nom' => 'required|string|max:255',
            'video_path' => 'required|file|mimes:mp4,mov,avi,wmv|max:102400', // Max 100MB
            'cours_id' => 'required|exists:courses,id' , 
            "level"=>"required|string" , 
            "duration"=>"required"
        ]);
        // dd($validated) ;
        if ($request->hasFile('video_path')) {
            $video = $request->file('video_path');
            $path = $video->store('videos', 'public');
            
            Playlist::create([
                'nom' => $request->nom,
                'description' => "",
                'video_path' => $path, 
                "level"=>$request->level , 
                "duration" =>$request->duration ,
                'cours_id' => $request->cours_id
            ]);

            return back()->with('success', 'Video added successfully');
        }

        return back()->with('error', 'No video file was uploaded');
    }

    public function destroy(Playlist $playlist)
    {
        // Delete the video file from storage
        if (Storage::disk('public')->exists($playlist->video_path)) {
            Storage::disk('public')->delete($playlist->video_path);
        }
        
        $playlist->delete();
        return back()->with('success', 'Video added successfully');
    }

    public function update(Request $request, Playlist $playlist)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400', // Max 100MB
            'cours_id' => 'required|exists:courses,id',
            'level' => 'required|string',
            'duration' => 'required'
        ]);

        $data = [
            'nom' => $request->nom,
            'cours_id' => $request->cours_id,
            'level' => $request->level,
            'duration' => $request->duration
        ];

        if ($request->hasFile('video_path')) {
            // Delete old video file
            if (Storage::disk('public')->exists($playlist->video_path)) {
                Storage::disk('public')->delete($playlist->video_path);
            }
            
            // Store new video file
            $video = $request->file('video_path');
            $data['video_path'] = $video->store('videos', 'public');
        }

        $playlist->update($data);
        return back()->with('success', 'Video updated successfully');
    }

    public function stream($id)
    {
        $playlist = Playlist::findOrFail($id);
        $path = storage_path('app/public/' . $playlist->video_path);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
