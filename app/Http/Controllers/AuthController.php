<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            $userId = $user->id;

            return redirect()->intended('/dashboard');
            // return redirect('dashboard');
            // return $this->dashboard();
            // return view('dashboard');
        }

        return back()->with('loginError', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function checkUsernameAvailability(Request $request)
    {
        $username = $request->input('username');

        // Cek apakah username sudah ada di database
        $user = User::where('username', $username)->first();

        if ($user) {
            // Username sudah terpakai
            return response()->json(['available' => false]);
        } else {
            // Username tersedia
            return response()->json(['available' => true]);
        }
    }

    public function checkNoHpAvailability(Request $request)
    {
        $nohp = $request->input('nohp');

        // Cek apakah username sudah ada di database
        $user = User::where('nohp', $nohp)->first();

        if ($user) {
            // Username sudah terpakai
            return response()->json(['available' => false]);
        } else {
            // Username tersedia
            return response()->json(['available' => true]);
        }
    }


    public function showRegistrationForm(Request $request, $id_arisan)
    {

        $role = $request->input('role');
        return view('auth.register', compact('role', 'id_arisan'), [
            'title' => 'Register',
            // 'id_arisan' => $id_arisan
        ]);
    }

    public function showRoleSelection()
    {
        return view('auth.choose-role', [
            'title' => 'Pilih Role',
        ]);
    }

    public function selectRole(Request $request)
    {
        $role = $request->input('role');

        if ($role == 'owner') {
            return redirect()->route('register.owner');
        } elseif ($role == 'user') {
            return redirect()->route('register.user');
        }
    }

    public function registerOwner()
    {
        return view('auth.register.register-owner', [
            'title' => 'Register',
        ]);
    }

    public function processOwnerRegistration(Request $request)
    {
        //return request()->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
            'nohp' => 'required|string|max:20',
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol(@, $, !, %, *, ?, atau &).',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $save = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nohp' => $request->nohp,
            'role' => 1,
            'active' => 0,
        ]);

        return redirect()->route('login');
    }

    public function registerUser()
    {
        return view('auth.register.register-user', [
            'title' => 'Register',
        ]);
    }

    public function processUserRegistration(Request $request)
    {
        // $ids = $request->input('id_arisan');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
            'nohp' => 'required|string|max:20',
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol(@, $, !, %, *, ?, atau &).',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $save = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nohp' => $request->nohp,
            'role' => 0,
            'active' => 0,
            // 'id_arisan' => $ids,
            // 'id_arisan' => $request->id_arisan,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi sukses, Silahkan Login!');
    }

    public function accountSetting()
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);
        return view('account-setting', [
            'title' => 'Pengaturan Akun',
            'active' => 'Account Setting',
            'users' => $account
        ], compact('account'));
    }

    public function processAccountSetting(Request $request)
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);

        $account->name = $request->input('name');
        $account->save();

        return redirect('/account-setting')->with('success', 'Perubahan telah disimpan.');
    }

    public function changePict()
    {
        $id = Auth::user()->id;
        $changePict = User::findOrFail($id);

        return view('change-pict', [
            'title' => 'Ubah Foto Profil',
            'active' => 'Change Picture',
            'users' => $changePict,
        ], compact('changePict'));
    }

    public function updatePict(Request $request)
    {
        // Validasi form jika diperlukan
        $request->validate([
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id = Auth::user()->id;
        $changePict = User::findOrFail($id);

        if ($request->hasFile('foto_profil')) {
            if ($changePict->foto_profil && Storage::exists($changePict->foto_profil)) {
                Storage::delete($changePict->foto_profil);
            }

            $filename = uniqid() . '.' . $request->file('foto_profil')->extension();

            $foto_profilPath = $request->file('foto_profil')->storeAs('public/foto_profil', $filename);

            $changePict->update([
                'foto_profil' => $foto_profilPath,
            ]);
        }

        return redirect()->route('change-pict')->with('success', 'Foto profil berhasil diubah.');
    }

    public function verificationAccount()
    {
        $id = Auth::user()->id;
        $verificationAccount = User::findOrFail($id);

        return view('verification-account', [
            'title' => 'Verifikasi Akun',
            'active' => 'Verifikasi Akun',
            'users' => $verificationAccount,
        ], compact('verificationAccount'));
    }

    public function processVerificationAccount(Request $request)
    {
        // Validasi form jika diperlukan
        $request->validate([
            'foto_ktp' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $id = Auth::user()->id;
        $verificationAccount = User::findOrFail($id);

        if ($request->hasFile('foto_ktp')) {
            if ($verificationAccount->foto_ktp && Storage::exists($verificationAccount->foto_ktp)) {
                Storage::delete($verificationAccount->foto_ktp);
            }

            $filename = uniqid() . '.' . $request->file('foto_ktp')->extension();

            $foto_ktpPath = $request->file('foto_ktp')->storeAs('public/foto_ktp', $filename);

            $verificationAccount->update([
                'foto_ktp' => $foto_ktpPath,
            ]);
        }

        return redirect()->route('verification-account')->with('success', 'Foto KTP berhasil di upload!.');
    }


    // public function changePassword($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('change-password', [
    //         'title' => 'Ubah Password',
    //         'active' => 'Change Password',
    //         'account' => $user
    //     ]);
    // }

    public function changePassword()
    {
        $id = Auth::user()->id;
        $changePassword = User::findOrFail($id);

        if (!$changePassword) {
            // Tambahkan logika untuk menangani pengguna yang tidak diotentikasi
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengubah password.');
        }

        return view('change-password', [
            'title' => 'Ubah Password',
            'active' => 'Change Password',
            'users' => $changePassword
        ], compact('changePassword'));
    }

    public function processChangePassword(Request $request)
    {
        $id = Auth::user()->id;
        $changePassword = User::findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->filled('password')) {
            $changePassword->password = bcrypt($request->input('password'));
        }

        $changePassword->save();

        return redirect()->route('change-password')->with('success', 'Password Telah Diubah!');
    }

    // public function store(Request $request)
    // {
    //     return request()->all();
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'username' => 'required|string|max:255|unique:users',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'nohp' => 'required|string|max:255',
    //         'role' => 'required',
    //         'active' => 'required',
    //     ]);

    //     $validatedData['password'] = Hash::make($validatedData['password']);

    //     // dd('Berhasil');
    //     User::create($validatedData);
    // }

}
