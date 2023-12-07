<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Arisan;
use App\Models\Notifikasi;
use App\Models\MemberArisan;
use Illuminate\Http\Request;
use App\Exports\OwnersExport;
use App\Exports\MembersExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log as LaravelLog;

class DashboardController extends Controller
{

    // public function index(Request $request)
    // {
    //     // Mendapatkan id_user yang sedang login
    //     $userId = Auth::id();

    //     $user = auth()->user();

    //     $arisans = Arisan::where('id_user', $user->id)
    //         ->where('status', 2)
    //         ->paginate(10);

    //     $arisan_runs = Arisan::where('status', 2)
    //         ->paginate(5);

    //     $totalArisan = Arisan::where('id_user', $userId)->count();

    //     $totalMember = MemberArisan::join('arisans', 'member_arisans.id_arisan', '=', 'arisans.id_arisan')
    //         ->where('arisans.id_user', $userId)
    //         ->distinct('member_arisans.id_user')
    //         ->count('member_arisans.id_user');

    //     $totalAllArisan = Arisan::count();
    //     $totalCompletedArisan = Arisan::where('status', 2)->count();
    //     $totalUsersWithRoleZero = User::where('role', 0)->count();
    //     $totalUsersWithRoleOne = User::where('role', 1)->count();

    //     return view('dashboard', [
    //         'active' => 'dashboard',
    //         'arisans' => $arisans,
    //         'arisan_runs' => $arisan_runs,
    //         'role' => $request,
    //         'totalArisan' => $totalArisan,
    //         'totalMember' => $totalMember,
    //         'totalUsersWithRoleZero' => $totalUsersWithRoleZero,
    //         'totalUsersWithRoleOne' => $totalUsersWithRoleOne,
    //         'totalAllArisan' => $totalAllArisan,
    //         'totalCompletedArisan' => $totalCompletedArisan,
    //     ]);
    // }

    public function index(Request $request)
    {
        // Mendapatkan id_user yang sedang login
        $userId = Auth::id();

        $user = auth()->user();

        $arisans = Arisan::where('id_user', $user->id)
            ->where('status', 2)
            ->where('active', 1)
            ->paginate(10);

        $arisan_suspends = Arisan::where('id_user', $user->id)
            ->where('status', 2)
            ->where('active', 0)
            ->paginate(10);

        $arisan_runs = Arisan::where('status', 2)
            ->paginate(5);

        $totalArisan = Arisan::where('id_user', $userId)->count();

        $totalMember = MemberArisan::join('arisans', 'member_arisans.id_arisan', '=', 'arisans.id_arisan')
            ->where('arisans.id_user', $userId)
            ->distinct('member_arisans.id_user')
            ->count('member_arisans.id_user');

        $totalAllArisan = Arisan::count();
        $totalCompletedArisan = Arisan::where('status', 2)->count();
        $totalUsersWithRoleZero = User::where('role', 0)->count();
        $totalUsersWithRoleOne = User::where('role', 1)->count();

        // Mendapatkan notifikasi untuk pengguna yang sedang login
        $notifications = Notifikasi::where('id_user', $userId)->get();

        $totalArisanMember = MemberArisan::where('id_user', $user->id)->count();

        return view('dashboard', [
            'active' => 'dashboard',
            'arisans' => $arisans,
            'arisan_suspends' => $arisan_suspends,
            'arisan_runs' => $arisan_runs,
            'role' => $request,
            'totalArisan' => $totalArisan,
            'totalMember' => $totalMember,
            'totalUsersWithRoleZero' => $totalUsersWithRoleZero,
            'totalUsersWithRoleOne' => $totalUsersWithRoleOne,
            'totalAllArisan' => $totalAllArisan,
            'totalCompletedArisan' => $totalCompletedArisan,
            'notifications' => $notifications,
            'totalArisanMember' => $totalArisanMember
        ]);
    }

    public function manageOwner(Request $request)
    {
        $search = $request->query('search');

        $owners = User::with('arisans_owner')->where('role', 1)->orderBy('id', 'DESC')->paginate(10);
        // dd($owners);
        return view('manage-owner', ['active' => 'manage-owner', 'owners' => $owners]);
    }

    public function searchManageOwner(Request $request)
    {
        $search = $request->query('search');

        $query = User::with('arisans_owner')->where('role', 1)->orderBy('id', 'DESC');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nohp', 'like', '%' . $search . '%');
            });
        }

        $owners = $query->paginate(10);

        return view('manage-owner', ['active' => 'manage-owner', 'owners' => $owners, 'search' => $search]);
    }

    public function addOwner(Request $request)
    {
        return view('add-owner', ['active' => 'manage-owner'])->with('role', $request);
    }

    public function processAddOwner(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|unique:users',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'nohp' => 'required',
            ]);

            // Simpan data pemilik baru ke database
            $owner = new User();
            $owner->username = $request->input('username');
            $owner->name = $request->input('name');
            $owner->email = $request->input('email');
            $owner->password = bcrypt('12345678');
            $owner->nohp = $request->input('nohp');
            $owner->role = 1;
            $owner->save();

            // Log the activity
            $logMessage = 'Admin berhasil membuat akun owner ' . $request->input('username');
            Log::create(['message' => $logMessage]);

            return redirect('/manage-owner')->with('success', 'Data Owner telah ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            return redirect('/manage-owner')->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during owner creation: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/manage-owner')->with('error', 'Error adding owner. Please try again.');
        }
    }


    public function editOwner($id)
    {
        $owner = User::findOrFail($id);
        return view('edit-owner', ['active' => 'manage-owner', 'owner' => $owner]);
    }

    public function processEditOwner(Request $request, $id)
    {
        try {
            $owner = User::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:8',
                'nohp' => 'required',
            ]);

            $oldData = $owner->toArray(); // Store the old data before updating

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

            // Log the activity
            $logMessage = 'Admin berhasil mengubah data owner (Username: ' . $owner->username . ')';
            Log::create(['message' => $logMessage]);

            return redirect('/manage-owner')->with('success', 'Perubahan Owner telah disimpan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            return redirect('/manage-owner')->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during owner edit: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/manage-owner')->with('error', 'Error editing owner. Please try again.');
        }
    }


    public function deleteOwner($id)
    {
        try {
            $owner = User::find($id);

            if (!$owner) {
                return redirect('/manage-owner')->with('error', 'Pemilik tidak ditemukan.');
            }

            // Log the activity before deleting the owner
            $logMessage = 'Admin berhasil menghapus data owner (Username: ' . $owner->username . ')';
            $logMessage .= ' dengan data ' . json_encode($owner->toArray());
            Log::create(['message' => $logMessage]);

            $owner->delete();

            return redirect('/manage-owner')->with('success', 'Data Owner telah dihapus.');
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during owner deletion: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/manage-owner')->with('error', 'Error deleting owner. Please try again.');
        }
    }


    public function exportOwnersExcel()
    {
        return Excel::download(new OwnersExport, 'data-owner.xlsx');
    }

    public function manageMember(Request $request)
    {
        // Logika untuk halaman dashboard user
        $search = $request->query('search');

        $query = User::where('role', 0);

        $members = User::with(['arisans', 'joinedArisans'])
            ->where('role', 0)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('manage-member', ['active' => 'manage-member', 'members' => $members])->with('role', $request);
    }
    public function searchManageMember(Request $request)
    {
        $search = $request->query('search');

        $query = User::where('role', 0);

        // Check if there is a search query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('nohp', 'LIKE', '%' . $search . '%');
            });
        }

        $members = $query->with(['arisans', 'joinedArisans'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('manage-member', ['active' => 'manage-member', 'members' => $members, 'search' => $search]);
    }
    public function addMember(Request $request)
    {
        // dd(auth()->user()->role);
        return view('add-member', ['active' => 'manage-member'])->with('role', $request);
    }

    public function processAddMember(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|unique:users',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'nohp' => 'required',
            ]);

            // Simpan data member baru ke database
            $member = new User();
            $member->username = $request->input('username');
            $member->name = $request->input('name');
            $member->email = $request->input('email');
            $member->password = bcrypt('12345678');
            $member->nohp = $request->input('nohp');
            $member->role = 0;
            $member->save();

            // Log the activity
            $logMessage = 'Admin berhasil menambahkan data member ' . $request->input('username');
            Log::create(['message' => $logMessage]);

            return redirect('/data-member')->with('success', 'Data Member telah ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            return redirect('/data-member')->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during member creation: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/data-member')->with('error', 'Error adding member. Please try again.');
        }
    }


    public function editMember($id)
    {
        $member = User::findOrFail($id);
        return view('edit-member', ['active' => 'manage-member', 'member' => $member]);
    }

    public function processEditMember(Request $request, $id)
    {
        try {
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

            // Log the activity
            $logMessage = 'Admin berhasil merubah data member (Username: ' . $member->username . ')';
            // $logMessage .= ' dengan data ' . json_encode($member->toArray());
            Log::create(['message' => $logMessage]);

            $member->save();

            return redirect('/data-member')->with('success', 'Perubahan Member telah disimpan.');
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during member edition: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/data-member')->with('error', 'Error editing member. Please try again.');
        }
    }

    public function deleteMember($id)
    {
        try {
            $member = User::find($id);
            if (!$member) {
                return redirect('/data-member')->with('error', 'User tidak ditemukan.');
            }

            // Log the activity
            $logMessage = 'Admin berhasil menghapus data member (Username: ' . $member->username . ')';
            // $logMessage .= ' dengan data ' . json_encode($member->toArray());
            Log::create(['message' => $logMessage]);

            $member->delete();

            return redirect('/data-member')->with('success', 'Data Member telah dihapus.');
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during member deletion: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/data-member')->with('error', 'Error deleting member. Please try again.');
        }
    }


    public function exportMembersExcel()
    {
        return Excel::download(new MembersExport, 'data-member.xlsx');
    }

    public function processActivateAccountOwner($id)
    {
        $owner = User::findOrFail($id);

        if (!$owner) {
            return redirect()->route('manage-owner')->with('error', 'Owner Tidak Ditemukan.');
        }

        $owner->active = 1;
        $owner->save();

        return redirect('/manage-owner')->with('success', 'Perubahan Owner telah disimpan.');
    }

    public function processActivateArisan($uuid)
    {
        try {
            $arisan = Arisan::where('uuid', $uuid)->firstOrFail();

            if (!$arisan) {
                return redirect()->route('data-arisan')->with('error', 'Arisan Tidak Ditemukan.');
            }

            // Log the activity
            $logMessage = 'Admin berhasil mengaktifkan arisan (UUID: ' . $uuid . ')';
            Log::create(['message' => $logMessage]);

            $arisan->active = 1;
            $arisan->status = 1;
            $arisan->save();

            return redirect('/data-arisan')->with('success', 'Arisan berhasil diaktifkan.');
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during arisan activation: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/data-arisan')->with('error', 'Error activating arisan. Please try again.');
        }
    }

    public function processDeactivateArisan($uuid)
    {
        try {
            $arisan = Arisan::where('uuid', $uuid)->firstOrFail();

            if (!$arisan) {
                return redirect()->route('data-arisan')->with('error', 'Arisan Tidak Ditemukan.');
            }

            // Log the activity
            $logMessage = 'Admin berhasil menonaktifkan arisan (UUID: ' . $uuid . ')';
            Log::create(['message' => $logMessage]);

            $arisan->active = 0;
            $arisan->status = 1;
            $arisan->save();

            return redirect('/data-arisan')->with('success', 'Arisan berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            // Log the exception
            LaravelLog::error('Error during arisan deactivation: ' . $e->getMessage());

            // Handle other exceptions
            return redirect('/data-arisan')->with('error', 'Error deactivating arisan. Please try again.');
        }
    }

    public function processActivateAccount($id)
    {
        try {
            $member = User::findOrFail($id);

            if (!$member) {
                return redirect()->route('data-member')->with('error', 'Member Tidak Ditemukan.');
            }

            // Log the activity
            $logMessage = 'Admin berhasil mengaktifkan akun member (Username: ' . $member->username . ')';
            Log::create(['message' => $logMessage]);

            $member->active = 1;
            $member->save();

            return redirect('/data-member')->with('success', 'Perubahan Member telah disimpan.');
        } catch (\Exception $e) {
            LaravelLog::error('Error during member activation: ' . $e->getMessage());

            return redirect('/data-member')->with('error', 'Error activating member. Please try again.');
        }
    }
}
