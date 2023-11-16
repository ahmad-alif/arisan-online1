<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);
        return view('profile.index', ['active' => 'profile'], compact('account'));

        // return view('account-setting', [
        //     'title' => 'Pengaturan Akun',
        //     'active' => 'Account Setting',
        //     'users' => $account
        // ], compact('account'));
    }

    public function ubahProfile()
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);
        return view('profile.edit-profile', [
            'title' => 'Pengaturan Akun',
            'active' => 'Account Setting',
            'users' => $account
        ], compact('account'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);

        $account->name = $request->input('name');
        // dd($request->all());
        $account->save();

        return redirect('/profile')->with('success', 'Perubahan telah disimpan.');
    }

    public function ubahFoto()
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);
        // dd($account);
        return view('profile.ubah-foto', ['active' => 'ubahfoto'], compact('account'));
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id = Auth::user()->id;
        $changePict = User::findOrFail($id);

        try {
            if ($request->hasFile('foto_profil')) {
                if ($changePict->foto_profil && Storage::exists($changePict->foto_profil)) {
                    Storage::delete($changePict->foto_profil);
                }

                $filename = uniqid() . '.' . $request->file('foto_profil')->extension();

                $foto_profilPath = $request->file('foto_profil')->storeAs('public/foto_profil', $filename);

                $changePict->update([
                    'foto_profil' => $foto_profilPath,
                ]);

                return redirect()->route('ubah-foto')->with('success', 'Foto profil berhasil diubah.');
            }
        } catch (\Exception $e) {
            return redirect()->route('ubah-foto')->with('error', 'Gagal mengunggah foto profil.');
        }

        return redirect()->route('ubah-foto')->with('error', 'Gagal mengunggah foto profil.');
    }

    public function ubahPassword()
    {
        $id = Auth::user()->id;
        $changePassword = User::findOrFail($id);

        return view('profile.ubah-password', [
            'active' => 'Ubah Password',
            'users' => $changePassword
        ], compact('changePassword'));
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $changePassword = User::findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->filled('password')) {
            // $changePassword->password = bcrypt($request->input('password'));
            $changePassword->password = $request->input('password');
        }

        // dd($request->all());

        $changePassword->save();

        return redirect()->route('ubah-password')->with('success', 'Password Telah Diubah!');
    }
}
