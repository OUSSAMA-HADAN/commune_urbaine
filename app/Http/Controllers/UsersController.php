<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.show', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Requires password confirmation
            'role' => 'required|in:admin,fonctionnaire,contable', // Adjust roles as needed
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.show')->with('success', 'User created successfully.');
    }

    // Show the reset password form with user details
    public function showResetForm($id)
    {
        $user = User::findOrFail($id); // Get user by ID
        return view('admin.users.reset', compact('user'));
    }

    // Update the user's password
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:6|confirmed', // Ensures password confirmation
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.users.show')->with('success', 'Password updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
    
            return redirect()->route('admin.users.show')->with('success', 'User deleted successfully.');
        } catch (\Exception) {
            return redirect()->route('admin.users.show')->with('error', 'Error deleting user.');
        }
    }
}
