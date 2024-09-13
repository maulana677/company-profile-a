<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.profile.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika ada avatar yang di-upload
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Upload avatar baru
            $avatarFile = $request->file('avatar');
            $avatarFileName = Str::random(40) . '.' . $avatarFile->getClientOriginalExtension();
            $avatarPath = $avatarFile->storeAs('avatars_users', $avatarFileName, 'public');
            $user->avatar = $avatarPath;
        }

        // Simpan perubahan
        $user->save();

        // Redirect dengan pesan sukses
        toastr()->success('Profil berhasil diperbarui!');
        return redirect()->route('profile.edit');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validateWithBag('passwordUpdate', [
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Mengatur flash message untuk berhasil
        return redirect()->route('profile.edit')->with('status', 'Password berhasil diperbarui!');
    }
}
