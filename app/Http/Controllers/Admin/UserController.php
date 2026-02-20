<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // public function create()
    // {
    //     return view('admin.users.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //         'role' => 'required|in:admin,seller,buyer'
    //     ]);

    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => $request->role,
    //         'status' => 'active'
    //     ]);

    //     return redirect()->route('admin.users.index')
    //         ->with('success', 'User berhasil ditambahkan');
    // }

    // public function edit(User $user)
    // {
    //     return view('admin.users.edit', compact('user'));
    // }

    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'role' => 'required|in:admin,seller,buyer'
    //     ]);

    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'role' => $request->role,
    //     ]);

    //     if ($request->password) {
    //         $user->update([
    //             'password' => Hash::make($request->password)
    //         ]);
    //     }

    //     return redirect()->route('admin.users.index')
    //         ->with('success', 'User berhasil diupdate');
    // }

    // public function destroy(User $user)
    // {
    //     if ($user->id === auth()->id()) {
    //         return back()->with('error', 'Tidak bisa menghapus akun sendiri');
    //     }

    //     $user->delete();

    //     return back()->with('success', 'User berhasil dihapus');
    // }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Cegah admin menonaktifkan dirinya sendiri
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Tidak bisa menonaktifkan akun sendiri.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Status user berhasil diperbarui.');
    }

}
