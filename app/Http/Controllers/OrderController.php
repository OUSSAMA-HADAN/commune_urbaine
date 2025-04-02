<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderMissionRequest;
use App\Models\OrdreMission;
use App\Models\User;

use Illuminate\Http\Request;

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

        OrdreMission::create($formFields);
        return to_route('admin.dashboard');
    }

    public function edit($id)
    {
        $order = OrdreMission::findOrFail($id);
        
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $ordre = OrdreMission::findOrFail($id);

        $formFields = $request->validated();

        $ordre->update($formFields);

        return to_route('admin.dashboard');
    }

    public function destroy($id)
    {
        $ordre = OrdreMission::findOrFail($id);

        try {
            $ordre = OrdreMission::findOrFail($id);
            $ordre->delete();
            return to_route('admin.dashboard');
        } catch (\Exception $e) {
            return to_route('admin.dashboard');
        }
    }
}
