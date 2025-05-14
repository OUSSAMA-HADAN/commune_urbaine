<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderMissionRequest;
use App\Models\OrdreMission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $orders = OrdreMission::with('user')
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhere('destination', 'like', '%' . $search . '%')
                    ->orWhere('objectif', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dashboard', compact('orders'));
    }
    public function create()
    {
        $user = User::all();
        return view('admin.Order.create', compact('user'));
    }

    public function store(OrderMissionRequest $request)
    {
        $formFields = $request->validated();

        // Handle file upload
        if ($request->file_path) {
            $uploadedFile = $request->file_path;
            $filename = time() . '_' . $uploadedFile->getClientOriginalName();
            $path = $uploadedFile->storeAs('missions', $filename, 'public');
            $formFields['file_path'] = $path;
        }

        OrdreMission::create($formFields);
        return to_route('admin.dashboard')->with('success', 'Ordre de mission créé avec succès.');
    }

    public function edit($id)
    {
        $order = OrdreMission::findOrFail($id);

        return view('admin.order.edit', compact('order'));
    }

    public function update(OrderMissionRequest $request, $id)
    {
         
        $ordre = OrdreMission::findOrFail($id);
        $formFields = $request->validated();
    
        // Handle file upload
        if ($request->file_path) {
            // Delete old file if exists
            if ($ordre->file_path && Storage::disk('public')->exists($ordre->file_path)) {
                Storage::disk('public')->delete($ordre->file_path);
            }

            $uploadedFile = $request->file_path;
            $filename = time() . '_' . $uploadedFile->getClientOriginalName();
            $path = $uploadedFile->storeAs('missions', $filename, 'public');
            $formFields['file_path'] = $path;
        }

        $ordre->update($formFields);
        return to_route('admin.dashboard')->with('success', 'Ordre de mission mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $ordre = OrdreMission::findOrFail($id);

        try {
            // Delete the file if it exists
            if ($ordre->file_path && Storage::disk('public')->exists($ordre->file_path)) {
                Storage::disk('public')->delete($ordre->file_path);
            }

            $ordre->delete();
            return to_route('admin.dashboard')->with('success', 'Ordre de mission supprimé avec succès.');
        } catch (\Exception $e) {
            return to_route('admin.dashboard')->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
