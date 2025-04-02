<?php

namespace App\Http\Controllers;

use App\Http\Requests\rapportMission;
use App\Models\RapportDeMission;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index(Request $request)
    {
        $query = RapportDeMission::with('user'); // Eager load the user relationship

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('sujet', 'like', "%{$search}%")
                    ->orWhere('contenu', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($qu) use ($search) {
                        $qu->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $rapports = $query->latest('dateSoumission')->paginate(10);

        return view('admin.rapport.show', compact('rapports'));
    }
}
