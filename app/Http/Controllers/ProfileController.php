<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('profiles.show', compact('profile'));
    }

    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        if (!$profile) {
            $profile = new Profile(['user_id' => Auth::id()]);
        }
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:255',
        ]);

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'profile_picture' => $request->hasFile('profile_picture') ? $request->file('profile_picture')->store('profiles', 'public') : $request->input('profile_picture'),
                'bio' => $request->input('bio')
            ]
        );
        

        return redirect()->route('profiles.show')->with('success', 'Profile updated successfully.');
    }
}

