<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure only logged-in users can access
    }

    // ✅ Admin-Only: List Users
    public function index(Request $request)
    {
        // Only admins can view users
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $users = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $users->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        return view('users.index', ['users' => $users->paginate(10)]);
    }

    // ✅ Admin-Only: Create User Form
    public function create()
    {
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        return view('users.create');
    }

    // ✅ Admin-Only: Store New User
    public function store(Request $request)
    {
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'admin' => 'nullable|boolean', // Optional admin field
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'admin' => $request->input('admin', false), // Default to false if not provided
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // ✅ Show User Profile (Only Admins or Self)
    public function show(User $user)
    {
        if (!Auth::user()->admin && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('users.show', compact('user'));
    }

    // ✅ Admin-Only: Edit User
    public function edit(User $user)
    {
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        return view('users.edit', compact('user'));
    }

    // ✅ Admin-Only: Update User
    public function update(Request $request, User $user)
    {
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'admin' => 'nullable|boolean',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'admin' => $request->input('admin', false),
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // ✅ Admin-Only: Delete User (Prevent Self-Deletion)
    public function destroy(User $user)
    {
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
