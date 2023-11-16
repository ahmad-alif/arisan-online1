<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        return view('dashboard', ['active' => 'dashboard'])->with('role', $request);
    }

    public function manageOwner(Request $request)
    {
        // Logika untuk halaman dashboard user
        $search = $request->query('search');

        $query = User::where('role', 1);

        $owners = User::where('role', 1)->orderby('id', 'DESC')->paginate(10);

        return view('manage-owner', ['active' => 'manage-owner', 'owners' => $owners])->with('role', $request);
    }

    public function addOwner(Request $request)
    {
        return view('add-owner', ['active' => 'dashboard'])->with('role', $request);
    }

    public function processAddOwner(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'nohp' => 'required',
        ]);

        // Simpan data pemilik baru ke database
        $owner = new User();
        $owner->username = $request->input('username');
        $owner->name = $request->input('name');
        $owner->email = $request->input('email');
        $owner->password = bcrypt($request->input('password'));
        $owner->nohp = $request->input('nohp');
        $owner->role = 1;
        $owner->save();

        return redirect('/manage-owner')->with('success', 'Data Owner telah ditambahkan.');
    }

    public function editOwner($id)
    {
        $owner = User::findOrFail($id);
        return view('edit-owner', ['active' => 'manage-owner', 'owner' => $owner]);
    }

    public function processEditOwner(Request $request, $id)
    {
        $owner = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'nohp' => 'required',
        ]);

        $owner->name = $request->input('name');
        $owner->username = $request->input('username');
        $owner->email = $request->input('email');

        if ($request->filled('password')) {
            $owner->password = bcrypt($request->input('password'));
        }

        $owner->nohp = $request->input('nohp');
        if ($request->hasFile('foto_profil')) {
            // Delete the old profile picture
            if ($owner->foto_profil && Storage::exists($owner->foto_profil)) {
                Storage::delete($owner->foto_profil);
            }

            // Upload and save the new profile picture
            $filename = uniqid() . '.' . $request->file('foto_profil')->extension();
            $foto_profilPath = $request->file('foto_profil')->storeAs('public/foto_profil', $filename);
            $owner->foto_profil = $foto_profilPath;
        }
        $owner->save();

        return redirect('/manage-owner')->with('success', 'Perubahan Owner telah disimpan.');
    }

    public function deleteOwner($id)
    {
        $owner = User::find($id);
        //dd($owner);
          if (!$owner) {
              return redirect('/manage-owner')->with('error', 'Pemilik tidak ditemukan.');
          }

          $owner->delete();

          return redirect('/manage-owner')->with('success', 'Data Owner telah dihapus.');
    }

    public function manageMember(Request $request)
    {
        // Logika untuk halaman dashboard user
        $search = $request->query('search');

        $query = User::where('role', 0);

        $members = User::where('role', 0)->paginate(10);

        return view('manage-member', ['active' => 'manage-member', 'members' => $members])->with('role', $request);
    }
    public function addMember(Request $request)
    {
        return view('add-member', ['active' => 'dashboard'])->with('role', $request);
    }

    public function processAddMember(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nohp' => 'required',
        ]);

        // Simpan data pemilik baru ke database
        $member = new User();
        $member->username = $request->input('username');
        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->password = bcrypt('12345678');
        $member->nohp = $request->input('nohp');
        $member->role = 0;
        $member->save();

        return redirect('/data-member')->with('success', 'Data Member telah ditambahkan.');
    }

    public function editMember($id)
    {
        $member = User::findOrFail($id);
        return view('edit-member', ['active' => 'manage-member', 'member' => $member]);
    }

    public function processEditMember(Request $request, $id)
    {
        $member = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'nohp' => 'required',
        ]);

        $member->name = $request->input('name');
        $member->username = $request->input('username');
        $member->email = $request->input('email');

        if ($request->filled('password')) {
            $member->password = bcrypt($request->input('password'));
        }

        $member->nohp = $request->input('nohp');

        if ($request->hasFile('foto_profil')) {
            // Delete the old profile picture
            if ($member->foto_profil && Storage::exists($member->foto_profil)) {
                Storage::delete($member->foto_profil);
            }

            // Upload and save the new profile picture
            $filename = uniqid() . '.' . $request->file('foto_profil')->extension();
            $foto_profilPath = $request->file('foto_profil')->storeAs('public/foto_profil', $filename);
            $member->foto_profil = $foto_profilPath;
        }
        $member->save();

        return redirect('/manage-member')->with('success', 'Perubahan Owner telah disimpan.');
    }

    public function deleteMember($id)
    {
        $member = User::find($id);
        // dd($member);
        if (!$member) {
            return redirect('/data-member')->with('error', 'User tidak ditemukan.');
        }

        $member->delete();

        return redirect('/data-member')->with('success', 'Data Member telah dihapus.');
    }

    public function processActivateAccountOwner($id)
    {
        $owner = User::findOrFail($id);

        if (!$owner) {
            // Handle the case where the member is not found
            return redirect()->route('manage-owner')->with('error', 'Owner Tidak Ditemukan.');
        }

        $owner->active = 1;
        $owner->save();

        return redirect('/manage-owner')->with('success', 'Perubahan Owner telah disimpan.');
    }

    public function processActivateAccount($id)
    {
        $member = User::findOrFail($id);

        if (!$member) {
            // Handle the case where the member is not found
            return redirect()->route('manage-member')->with('error', 'Member Tidak Ditemukan.');
        }

        $member->active = 1;
        $member->save();

        return redirect('/manage-member')->with('success', 'Perubahan Owner telah disimpan.');
    }
}
