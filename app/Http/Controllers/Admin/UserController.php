<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
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
        'password' => 'required|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
}

   public function show(string $id)
{
    $user = User::findOrFail($id);

    return view('admin.users.show', compact('user'));
}

   public function edit(string $id)
{
    $user = User::findOrFail($id);

    return view('admin.users.edit', compact('user'));
}



public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {

        $request->validate([
            'password' => 'confirmed|min:8',
        ]);

        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
}

 public function destroy(string $id)
{
    $user = User::findOrFail($id);

    $user->delete();

    return redirect()
        ->route('users.index')
        ->with('success', 'User deleted successfully.');
}
}
