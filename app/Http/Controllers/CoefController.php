<?php

namespace App\Http\Controllers;

use App\Models\Coef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
            $id = $request->id ;
            $data = DB::table('exam_records as er')
                ->join('exames as e', 'er.exames_id', '=', 'e.id')
                ->join('courses as c', 'c.id', '=', 'e.courses_id')
                ->join('coefs as co', 'co.courses_id', '=', 'c.id')
                ->where('er.users_id', 115)
                ->groupBy('e.courses_id', 'c.name')
                ->selectRaw('c.name, SUM(er.note * co.coef) / SUM(co.coef) AS weighted_avg_note')
                ->get();
        
            return response()->json($data  , 200 , ['Access-Control-Allow-Origin' => '*']);
        
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
    public function show(Coef $coef)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coef $coef)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coef $coef)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coef $coef)
    {
        //
    }
}
