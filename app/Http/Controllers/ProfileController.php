<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        // For demo purposes, get the first user or create a default one
        $user = User::first();
        if (!$user) {
            // Create a demo user if none exists
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => Hash::make('password'),
            ]);
        }
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        // For demo purposes, get the first user or create a default one
        $user = User::first();
        if (!$user) {
            // Create a demo user if none exists
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => Hash::make('password'),
            ]);
        }
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // For demo purposes, get the first user or create a default one
        $user = User::first();
        if (!$user) {
            // Create a demo user if none exists
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Hapus file lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
