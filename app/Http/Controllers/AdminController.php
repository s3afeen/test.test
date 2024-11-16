<?php

namespace App\Http\Controllers;

use App\Models\User; // Change this to your regular user model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index($id)
    {
        $admins = User::all(); // Adjust to your model
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Adjust to your model
            'password' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData); // Adjust to your model
        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }

    public function show()
    {
        $admin = Auth::user(); // استرجاع الأدمن المصادق عليه باستخدام الحارس 'admin'
        return view('admin.profile', compact('admin')); // تمرير بيانات الأدمن إلى الـ view
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id); // Adjust to your model
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id, // Adjust to your model
        ]);

        $admin = User::findOrFail($id); // Adjust to your model
        $admin->update($validatedData);
        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id); // Adjust to your model
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

    public function showProfile()
    {
        $admin = Auth::user(); // Get the current authenticated user
        return view('admin.profile', compact('admin')); // Pass user data to the view
    }
}
