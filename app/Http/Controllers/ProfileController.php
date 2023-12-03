<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Hash;
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers;
use App\Http\Controllers\Controller;

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

                return redirect()->route('ubah-profile')->with('success', 'Foto profil berhasil diubah.');
            }
        } catch (\Exception $e) {
            return redirect()->route('ubah-profile')->with('error', 'Gagal mengunggah foto profil.');
        }

        return redirect()->route('ubah-profile')->with('error', 'Gagal mengunggah foto profil.');
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
        try {
            // Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);

            // Match Old Password
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->with('alert', 'error')->with('message', 'Password Lama Salah.');
            }

            // Update New Password
            $updateResult = User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            if ($updateResult) {
                return back()->with('alert', 'success')->with('message', 'Update Password Berhasil.');
            } else {
                throw new \Exception('Gagal mengupdate password.');
            }
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return a specific error message
            return back()->with('alert', 'error')->with('message', $e->getMessage());
        }
    }

    public function checkOldPassword(Request $request) {
        $oldPassword = $request->input('old_password');
        $user = Auth::user();

        if (Hash::check($oldPassword, $user->password)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }
}
