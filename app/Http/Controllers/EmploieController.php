<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Http\Request;

class EmploieController extends Controller
{
    public function index(){
        $perPage = 1; // Number of items per page
        $currentPage = request()->query('page', 1); // Get current page from URL
        $groupes = Groupe::all();
    
        // Manually slice the array
        $groupesListe = $groupes->slice(($currentPage - 1) * $perPage, $perPage);
    
        $totalPages = ceil($groupes->count() / $perPage); // Calculate total pages

        return view('Pages.Teacher.Emploie', compact('groupes', 'groupesListe', 'currentPage', 'totalPages'));
    }
}
