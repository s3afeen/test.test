<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
{
    $search_param = $request->input('search_param'); // جلب الباراميتر من الطلب

    if ($search_param) {
        $users_query = User::where('name', 'like', '%' . $search_param . '%'); // البحث عن المستخدمين حسب الاسم
    } else {
        $users_query = User::query(); // لو ما في باراميتر بحث، استرجع كل المستخدمين
    }

    $users = $users_query->get();

    return view('users.index', compact('users', 'search_param'));
}

    public function create()
    {
        $users = User::all();
        return view('users.create', compact('users'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // استخدم Hash::make
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    // 4. عرض تفاصيل مستخدم معين
    public function show($id)
    {
        $user = User::findOrFail($id); // البحث عن المستخدم المطلوب
        return view('users.show', compact('user')); // عرض صفحة تفاصيل المستخدم
    }

    // 5. عرض نموذج تعديل مستخدم معين
    public function edit($id)
    {
        $user = User::findOrFail($id); // البحث عن المستخدم المطلوب
        return view('users.edit', compact('user')); // عرض نموذج تعديل المستخدم
    }

    // 6. تحديث بيانات المستخدم في قاعدة البيانات
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password); // استخدم Hash::make
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

    // 7. حذف مستخدم معين
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    
}




