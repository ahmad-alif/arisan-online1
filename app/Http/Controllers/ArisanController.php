<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arisan;
use App\Models\MemberArisan;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreArisanRequest;
use App\Http\Requests\UpdateArisanRequest;

class ArisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $arisans = Arisan::paginate(10);
        return view('arisan.data-arisan', ['active' => 'manage-arisan', 'arisans' => $arisans]);
    }

    public function manageArisan()
    {
        $user = auth()->user();

        $arisans = Arisan::where('id_user', $user->id)->paginate(10);

        return view('arisan.manage-arisan', ['active' => 'manage-arisan', 'arisans' => $arisans]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function addArisan()
    {
        $users = User::where('role', 1)->get();

        // $users = User::all();

        return view('arisan.add-arisan', ['active' => 'add-arisan'])->with('users', $users);
    }

    public function processAddArisan(Request $request)
    {
        $request->validate([
            'nama_arisan' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'img_arisan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_user' => 'required',
        ]);

        if ($request->hasFile('img_arisan')) {
            $img_arisanPath = $request->file('img_arisan')->store('arisan_images', 'public');
        }

        $arisan = new Arisan();
        $arisan->nama_arisan = $request->input('nama_arisan');
        $arisan->start_date = $request->input('start_date');
        $arisan->end_date = $request->input('end_date');

        // Store the image path in the database if an image was uploaded
        if (isset($img_arisanPath)) {
            $arisan->img_arisan = $img_arisanPath;
        }

        $arisan->id_user = $request->input('id_user');

        $arisan->save();


        return redirect('/manage-arisan')->with('success', 'Data Owner telah ditambahkan.');
    }

    public function editArisan($id)
    {

        $arisan = Arisan::where('id_arisan', $id)->first();
        return view('arisan.edit-arisan', ['active' => 'manage-arisan', 'arisan' => $arisan]);
    }

    public function processEditArisan(Request $request, $id)
    {
        $arisan = Arisan::where('id_arisan', $id)->first();

        $request->validate([
            'nama_arisan' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $arisan->nama_arisan = $request->input('nama_arisan');
        $arisan->start_date = $request->input('start_date');
        $arisan->end_date = $request->input('end_date');

        if ($request->hasFile('img_arisan')) {
            // Delete the old profile picture
            if ($arisan->img_arisan && Storage::exists($arisan->img_arisan)) {
                Storage::delete($arisan->img_arisan);
            }

            // Upload and save the new profile picture
            $filename = uniqid() . '.' . $request->file('img_arisan')->extension();
            $img_arisanPath = $request->file('img_arisan')->storeAs('public/arisan_images', $filename);
            $arisan->img_arisan = $img_arisanPath;
        }
        $arisan->save();

        return redirect('/manage-arisan')->with('success', 'Perubahan Owner telah disimpan.');
    }

    public function deleteArisan($id)
    {
        $arisan = Arisan::find($id)->first();
        // dd($arisan);
        $arisan = Arisan::where('id_arisan', $id)->first();
        if (!$arisan) {
            return redirect('/manage-arisan')->with('error', 'Arisan tidak ditemukan.');
        }

        $arisan->delete();

        return redirect('/manage-arisan')->with('success', 'Data Arisan telah dihapus.');
    }

    public function addArisanOwner()
    {
        $id = Auth::user()->id;
        $users = User::findOrFail($id);

        // $users = User::all();

        return view('arisan.add-arisan-owner', ['active' => 'add-arisan', 'users' => $users]);
    }

    // public function processAddArisanOwner(Request $request)
    // {
    //     $request->validate([
    //         'nama_arisan' => 'required|string|max:255',
    //         'start_date' => 'required',
    //         'end_date' => 'required',
    //         'img_arisan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'id_user' => 'required',
    //     ]);

    //     if ($request->hasFile('img_arisan')) {
    //         $img_arisanPath = $request->file('img_arisan')->store('arisan_images', 'public');
    //     }

    //     $arisan = new Arisan();
    //     $arisan->nama_arisan = $request->input('nama_arisan');
    //     $arisan->start_date = $request->input('start_date');
    //     $arisan->end_date = $request->input('end_date');

    //     // Store the image path in the database if an image was uploaded
    //     if (isset($img_arisanPath)) {
    //         $arisan->img_arisan = $img_arisanPath;
    //     }

    //     $arisan->id_user = $request->input('id_user');

    //     $arisan->save();


    //     return redirect('/manage-arisan')->with('success', 'Data Owner telah ditambahkan.');
    // }
    // public function processAddArisanOwner(Request $request)
    // {
    //     // Validasi input data
    //     $request->validate([
    //         'nama_arisan' => 'required|string|max:255',
    //         'deskripsi' => 'required|string',
    //         'start_date' => 'required|date',
    //         'max_member' => 'required|integer',
    //         'deposit_frequency' => 'required|in:1,2,4',
    //         'payment_amount' => 'required|numeric',
    //         'img_arisan' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Hitung end_date berdasarkan max_member dan deposit_frequency
    //     $maxMember = $request->input('max_member');
    //     $depositFrequency = $request->input('deposit_frequency');
    //     $startDate = \Carbon\Carbon::parse($request->input('start_date'));
    //     $endDate = $startDate->copy()->addWeeks($maxMember * $depositFrequency);

    //     // Dapatkan ID pengguna yang sedang login
    //     $userId = Auth::id();

    //     // Simpan data arisan ke dalam database
    //     $arisan = new Arisan();
    //     $arisan->nama_arisan = $request->input('nama_arisan');
    //     $arisan->deskripsi = $request->input('deskripsi');
    //     $arisan->start_date = $startDate;
    //     $arisan->end_date = $endDate;
    //     $arisan->status = 0;
    //     $arisan->active = 0;
    //     $arisan->max_member = $maxMember;
    //     $arisan->deposit_frequency = $depositFrequency;
    //     $arisan->payment_amount = $request->input('payment_amount');
    //     $arisan->id_user = $userId; // Simpan ID pengguna

    //     // Upload gambar jika ada
    //     if ($request->hasFile('img_arisan')) {
    //         $imagePath = $request->file('img_arisan')->store('arisan_images', 'public');
    //         $arisan->img_arisan = $imagePath;
    //     }

    //     // Simpan data arisan
    //     // $arisan->save();
    //     dd($arisan);

    //     // Redirect atau berikan pesan sukses
    //     return redirect('/manage-arisan')->with('success', 'Arisan berhasil ditambahkan');
    // }
    public function processAddArisanOwner(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nama_arisan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'start_date' => 'required|date',
            'max_member' => 'required|integer',
            'deposit_frequency' => 'required|in:1,2,4',
            'payment_amount' => 'required|numeric',
            'img_arisan' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Simpan data arisan ke dalam database dengan status awal 0 (tidak aktif)
        $arisan = new Arisan();
        $arisan->nama_arisan = $request->input('nama_arisan');
        $arisan->deskripsi = $request->input('deskripsi');
        $arisan->start_date = \Carbon\Carbon::parse($request->input('start_date'));
        $arisan->status = 0; // Status awal (tidak aktif)
        $arisan->active = 0; // Atur active sesuai kebutuhan
        $arisan->max_member = $request->input('max_member');
        $arisan->deposit_frequency = $request->input('deposit_frequency');
        $arisan->payment_amount = $request->input('payment_amount');
        $arisan->id_user = $userId; // Simpan ID pengguna

        // Upload gambar jika ada
        if ($request->hasFile('img_arisan')) {
            $imagePath = $request->file('img_arisan')->store('arisan_images', 'public');
            $arisan->img_arisan = $imagePath;
        }

        // Simpan data arisan
        $arisan->save();
        // dd($arisan);

        // Redirect atau berikan pesan sukses
        return redirect('/manage-arisan')->with('success', 'Arisan berhasil ditambahkan');
    }

    public function startArisan($id)
    {
        // Pastikan owner atau pengguna yang berwenang melakukan konfirmasi
        $arisan = Arisan::find($id);
        $userId = Auth::id();

        if ($arisan->id_user == $userId) {
            // Ubah status menjadi 2 (aktif)
            $arisan->status = 2;

            // Hitung jumlah anggota dari tabel member_arisans
            $memberCount = MemberArisan::where('id_arisan', $id)->count();

            // Hitung end_date berdasarkan jumlah anggota dan deposit_frequency
            $depositFrequency = $arisan->deposit_frequency;
            $startDate = \Carbon\Carbon::parse($arisan->start_date);
            $endDate = $startDate->copy()->addWeeks($memberCount * $depositFrequency);

            $arisan->end_date = $endDate;

            $arisan->save();

            return redirect('/manage-arisan')->with('success', 'Arisan berhasil diaktifkan');
        } else {
            return redirect('/manage-arisan')->with('error', 'Anda tidak memiliki izin untuk mengaktifkan arisan ini');
        }
    }


    public function listArisan(Request $request)
    {
        $search = $request->input('search', '');

        $query = Arisan::query();

        if ($search) {
            $query->where('nama_arisan', 'like', "%$search%");
        }

        $arisans = $query->paginate(9);

        return view('arisan.list-arisan', ['active' => 'list-arisan', 'search' => $search, 'arisans' => $arisans]);
    }

    public function detailArisan($id)
    {
        $arisan = Arisan::find($id);

        if (!$arisan) {
            // Handle the case where the Arisan with the given ID is not found
            return redirect()->route('list-arisan')->with('error', 'Arisan not found');
        }

        return view('arisan.detail-arisan', ['active' => 'detail-arisan', 'arisan' => $arisan]);
        // return view('arisan.detail', ['arisan' => $arisan]);
    }


    public function joinArisan(Arisan $arisan)
    {
        $user = auth()->user();

        // Check if the user is already a member of the Arisan.
        if (!$arisan->members()->where('id_user', $user->id)->exists()) {
            // If not a member, add the user to the Arisan.
            $arisan->members()->attach($user);
            return redirect()->route('list-arisan')->with('success', 'You have successfully joined the Arisan!');
        } else {
            return redirect()->route('list-arisan')->with('error', 'You are already a member of this Arisan.');
        }
    }


    public function search(Request $request)
    {
        $search = $request->input('search', '');

        $query = Arisan::query();

        if ($search) {
            $query->where('nama_arisan', 'like', "%$search%");
        }

        $arisans = $query->paginate(9);

        // Sanitasi data yang akan ditampilkan
        $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');

        return view('arisan.list-arisan', ['active' => 'list-arisan', 'search' => $search, 'arisans' => $arisans]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArisanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Arisan $arisan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arisan $arisan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArisanRequest $request, Arisan $arisan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arisan $arisan)
    {
        //
    }
}
