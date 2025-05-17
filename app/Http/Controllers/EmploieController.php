<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploieTemp;
use Illuminate\Support\Facades\Validator;

class EmploieController extends Controller
{
    public function index(Request $request)
    {
        $selectedGroup = $request->get('group', 'DEV201');
        
        $schedules = EmploieTemp::where('grp', $selectedGroup)->get();
        
        return view('Emploie', compact('schedules', 'selectedGroup'));
    }

    public function view(Request $request)
    {
        $selectedGroup = $request->get('group', 'all');
        
        if ($selectedGroup === 'all') {
            $schedules = EmploieTemp::orderBy('grp')->orderBy('day')->orderBy('time_slot')->get();
        } else {
            $schedules = EmploieTemp::where('grp', $selectedGroup)
                                   ->orderBy('day')->orderBy('time_slot')
                                   ->get();
        }
        
        // Group schedules by group for easier display
        $schedulesByGroup = $schedules->groupBy('grp');
        
        return view('VoirEmploie', compact('schedulesByGroup', 'selectedGroup'));
    }

    public function mySchedule()
    {
        // For now, hardcoded to DEV201
        $selectedGroup = auth()->user()->group;
        
        $schedules = EmploieTemp::where('grp', $selectedGroup)
                               ->orderBy('day')
                               ->orderBy('time_slot')
                               ->get();
        
        return view('MonEmploie', compact('schedules', 'selectedGroup'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grp' => 'required|in:DEV201,DEV202,DEV203,DEV204',
            'entries' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $group = $request->grp;
        $entries = $request->entries;

        try {
            foreach ($entries as $day => $timeSlots) {
                foreach ($timeSlots as $timeSlot => $data) {
                    if (empty($data['subject']) && empty($data['teacher']) && empty($data['room'])) {
                        EmploieTemp::where([
                            'day' => $day,
                            'time_slot' => $timeSlot,
                            'grp' => $group,
                        ])->delete();
                    } else {
                        EmploieTemp::updateOrCreate(
                            [
                                'day' => $day,
                                'time_slot' => $timeSlot,
                                'grp' => $group,
                            ],
                            [
                                'subject' => $data['subject'] ?? null,
                                'teacher' => $data['teacher'] ?? null,
                                'room' => $data['room'] ?? null,
                            ]
                        );
                    }
                }
            }

            return redirect()->route('emploie.index', ['group' => $group])
                ->with('success', 'Emploi du temps sauvegardé avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Erreur lors de la sauvegarde: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
