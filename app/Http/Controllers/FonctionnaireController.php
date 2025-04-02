<?php

namespace App\Http\Controllers;

use App\Models\OrdreMission;
use App\Models\RapportDeMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FonctionnaireController extends Controller
{
    public function dashboard()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Get all missions assigned to this fonctionnaire
        $missions = OrdreMission::where('idFonctionnaire', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Count missions by status
        $pendingMissions = OrdreMission::where('idFonctionnaire', $user->id)
            ->where('etatRemboursement', 'EN ATTEND')
            ->count();

        $completedMissions = OrdreMission::where('idFonctionnaire', $user->id)
            ->where('etatRemboursement', 'Completed')
            ->count();

        $totalMissions = OrdreMission::where('idFonctionnaire', $user->id)->count();

        // Get reports submitted by this fonctionnaire
        $rapports = RapportDeMission::whereHas('ordreMission', function ($query) use ($user) {
            $query->where('idFonctionnaire', $user->id);
        })->count();

        return view('fonctionnaire.dashboard', compact(
            'missions',
            'pendingMissions',
            'completedMissions',
            'totalMissions',
            'rapports'
        ));
    }

    public function showMission($id)
    {
        $mission = OrdreMission::findOrFail($id);

        // Make sure the mission belongs to the authenticated user
        if ($mission->idFonctionnaire != Auth::id()) {
            return redirect()->route('fonctionnaire.dashboard')->with('error', 'Vous n\'êtes pas autorisé à voir cette mission.');
        }

        // Check if there's a report for this mission
        $rapport = RapportDeMission::where('idOrdreMission', $mission->id)->first();

        return view('fonctionnaire.mission.show', compact('mission', 'rapport'));
    }

    public function createRapport($missionId)
    {
        $mission = OrdreMission::findOrFail($missionId);

        // Make sure the mission belongs to the authenticated user
        if ($mission->idFonctionnaire != Auth::id()) {
            return redirect()->route('fonctionnaire.dashboard')->with('error', 'Vous n\'êtes pas autorisé à voir cette mission.');
        }

        // Check if a report already exists
        $existingRapport = RapportDeMission::where('idOrdreMission', $missionId)->first();
        if ($existingRapport) {
            return redirect()->route('fonctionnaire.mission.show', $missionId)->with('error', 'Un rapport existe déjà pour cette mission.');
        }

        return view('fonctionnaire.rapport.create', compact('mission'));
    }

    public function storeRapport(Request $request, $missionId)
    {
        $request->validate([
            'sujet' => 'required|string|max:255',
            'contenu' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120', // 5MB max
        ]);

        $mission = OrdreMission::findOrFail($missionId);

        // Make sure the mission belongs to the authenticated user
        if ($mission->idFonctionnaire != Auth::id()) {
            return redirect()->route('fonctionnaire.dashboard')->with('error', 'Vous n\'êtes pas autorisé à voir cette mission.');
        }

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('rapports', $filename, 'public');
        }

        // Create the rapport
        $rapport = new RapportDeMission();
        $rapport->idOrdreMission = $missionId;
        $rapport->sujet = $request->sujet;
        $rapport->contenu = $request->contenu;
        $rapport->dateSoumission = now();
        $rapport->file_path = $filePath;
        $rapport->save();

        return redirect()->route('fonctionnaire.mission.show', $missionId)->with('success', 'Rapport soumis avec succès.');
    }
    public function missions()
    {
        // Get missions assigned to the logged-in fonctionnaire
        $user = Auth::user();
        $missions = OrdreMission::where('idFonctionnaire', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('fonctionnaire.missions', compact('missions'));
    }

    public function rapports()
    {
        // Get reports submitted by the logged-in fonctionnaire
        $user = Auth::user();
        $rapports = RapportDeMission::whereHas('ordreMission', function ($query) use ($user) {
            $query->where('idFonctionnaire', $user->id);
        })
            ->orderBy('dateSoumission', 'desc')
            ->paginate(10);

        return view('fonctionnaire.rapports', compact('rapports'));
    }
}
