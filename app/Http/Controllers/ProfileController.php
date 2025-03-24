<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Incorrect old password']);
        }

        $user->password = Hash::make($request->new_password);
/** @var \App\Models\User $user */
$user = Auth::user();
$user->password = Hash::make($request->new_password);
$user->save();

        return back()->with('success', 'Password updated successfully');
    }
}
