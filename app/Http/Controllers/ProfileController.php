<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Load recent activity/stats logic here for profile
        $stats = [
            'Total Proyek' => \App\Models\Project::whereHas('members', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count(),
            'Pesanan Terekam' => \App\Models\Order::count(),
        ];

        return view('pages.profile', [
            'activePage' => 'profile',
            'user' => $user,
            'stats' => $stats,
        ]);
    }

    public function settings()
    {
        $user = Auth::user();

        return view('pages.settings', [
            'activePage' => 'settings',
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'jabatan' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'avatar_url' => 'nullable|url',
        ]);

        if ($request->has('avatar_url')) {
            $user->avatar = $validated['avatar_url'];
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->jabatan = $validated['jabatan'] ?? $user->jabatan;
        $user->telepon = $validated['telepon'] ?? $user->telepon;

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($validated['current_password'], $user->password)) {
            return redirect()->route('settings')->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('settings')->with('success', 'Password berhasil diubah!');
    }
}
