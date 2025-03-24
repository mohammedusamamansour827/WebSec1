<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Task; // optional


class AdminController extends Controller
{
    /**
     * Ensure only admins can access this controller.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    /**
     * Display a list of all users.
     */
    public function index()
    {
        return view('admin.dashboard', [
            'userCount' => User::count(),
            'taskCount' => Task::count(),
            'latestUsers' => User::latest()->take(5)->get()
        ]);
    }

    /**
     * Show a specific user's details.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user details.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'admin' => 'sometimes|boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'admin' => $request->has('admin') ? 1 : 0,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Change a user's password.
     */
    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User password updated successfully.');
    }

    /**
     * Delete a user (Prevents deleting super admin).
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting the super admin (Example: user ID 1)
        if ($user->id === 1) {
            return redirect()->route('admin.users.index')->with('error', 'Super admin cannot be deleted.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed', // 👈 Ensures password matches confirmation
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'admin' => $request->has('admin') ? 1 : 0,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
}

}
