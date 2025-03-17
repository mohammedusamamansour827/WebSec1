<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ✅ Ensure the controller extends the base Controller class
    public function __construct()
    {
        $this->middleware('auth'); // Ensures only authenticated users can access this controller
    }

    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $users->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        return view('users.index', ['users' => $users->paginate(10)]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function show(User $user)
{
    return view('users.show', compact('user'));
}

}

