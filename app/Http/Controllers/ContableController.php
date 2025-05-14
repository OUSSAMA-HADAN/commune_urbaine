<?php

namespace App\Http\Controllers;

use App\Models\OrdreMission;
use App\Models\RapportDeMission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContableController extends Controller
{
    public function dashboard()
    {
        // Get missions pending reimbursement
        $pendingReimbursements = OrdreMission::where('etatRemboursement', 'EN ATTEND')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate total pending reimbursement amount
        $totalPendingAmount = OrdreMission::where('etatRemboursement', 'EN ATTEND')
            ->sum('montantRemboursement'); // Assume you'll add this field to the migration

        // Get recently completed missions
        $completedMissions = OrdreMission::where('etatRemboursement', 'Completed')
            ->with('user')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('contable.dashboard', compact(
            'pendingReimbursements', 
            'totalPendingAmount', 
            'completedMissions'
        ));
    }

    public function processReimbursement(Request $request, $id)
    {
        $mission = OrdreMission::findOrFail($id);
    
        $request->validate([
            'status' => 'required|in:Completed,Rejected',
            'comments' => 'nullable|string|max:500'
        ]);
    
        $mission->etatRemboursement = $request->status;
        $mission->commentairesRemboursement = $request->comments;
        $mission->save();
    
        // Add a flash message
        $statusMessage = $request->status === 'Completed' 
            ? 'Remboursement approuvé avec succès.' 
            : 'Remboursement rejeté.';
    
        return redirect()->route('contable.dashboard')
            ->with('success', $statusMessage);
    }
    public function processReimbursementDetail($id)
{
    // Fetch the mission with its associated user and rapport
    $mission = OrdreMission::with(['user', 'rapport'])->findOrFail($id);

    return view('contable.reimbursement-detail', compact('mission'));
}
    public function reimbursementHistory(Request $request)
    {
        $query = OrdreMission::with('user');
    
        // Filter by status
        if ($request->filled('status')) {
            $query->where('etatRemboursement', $request->status);
        }
    
        // Filter by date range
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('dateDebut', [
                $request->date_from, 
                $request->date_to
            ]);
        }
    
        $reimbursements = $query->orderBy('created_at', 'desc')->paginate(15);
    
        return view('contable.reimbursement-history', compact('reimbursements'));
    }
    public function validateReimbursement(Request $request, $id)
{
    $mission = OrdreMission::findOrFail($id);

    $validatedData = $request->validate([
        'montant_remboursement' => 'required|numeric|min:0',
        'status' => 'required|in:Completed,Rejected',
        'commentaires' => 'nullable|string|max:500'
    ]);

    // Update mission with reimbursement details
    $mission->montantRemboursement = $validatedData['montant_remboursement'];
    $mission->etatRemboursement = $validatedData['status'];
    $mission->commentairesRemboursement = $validatedData['commentaires'] ?? null;
    $mission->save();

    $message = $mission->etatRemboursement === 'Completed' 
        ? 'Remboursement approuvé avec succès.' 
        : 'Remboursement rejeté.';

    return redirect()->route('contable.dashboard')
        ->with('success', $message);
}
}