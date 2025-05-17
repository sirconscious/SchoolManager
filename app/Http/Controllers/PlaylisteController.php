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
        return view("playliste", compact("playlists", "courses"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:102400', // Max 100MB
            'cours_id' => 'required|exists:courses,id'
        ]);

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = $video->store('videos', 'public');
            
            Playlist::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'video_path' => $path,
                'cours_id' => $request->cours_id
            ]);

            return redirect()->route('playlists.index')->with('success', 'Video added successfully');
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
        return redirect()->route('playlists.index')->with('success', 'Video deleted successfully');
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
