<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Arisan;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use App\Models\MemberArisan;
use Illuminate\Http\Request;
use App\Exports\ArisansExport;
use Barryvdh\DomPDF\PDF as DomPDF;
use App\Exports\ManageArisanExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreArisanRequest;
use App\Http\Requests\UpdateArisanRequest;

class ArisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function convertDepositFrequencyToMonths($depositFrequency)
    {
        switch ($depositFrequency) {
            case 1:
                return 1; // 1 minggu dianggap sebagai 1 bulan
            case 2:
                return 2; // 2 minggu dianggap sebagai 2 bulan
            case 4:
                return 1; // 1 bulan
            default:
                return 1; // Default 1 bulan jika nilai tidak sesuai
        }
    }

    public function index(Request $request)
    {
        // $arisans = Arisan::paginate(10);
        $arisans = Arisan::orderBy('id_arisan', 'DESC')->get();
        return view('arisan.data-arisan', ['active' => 'manage-arisan', 'arisans' => $arisans]);
    }

    public function exportArisansExcel()
    {
        return Excel::download(new ArisansExport, 'data-arisan.xlsx');
    }

    public function manageArisan()
    {
        $user = auth()->user();

        $arisans = Arisan::where('id_user', $user->id)->orderBy('id_arisan', 'DESC')->paginate(10);

        return view('arisan.manage-arisan', ['active' => 'manage-arisan', 'arisans' => $arisans]);
    }

    // public function exportExcelManageArisan()
    // {
    //     return Excel::download(new ArisanExport, 'arisans.xlsx');
    // }

    public function exportPDFmanageArisan()
    {
        $user = auth()->user();
        $arisans = Arisan::where('id_user', $user->id)->orderBy('id_arisan', 'DESC')->get();

        $pdf = app(DomPDF::class)->loadView('arisan.export-pdf-manage-arisan', compact('arisans'));

        // Nama file PDF
        $filename = 'arisans.pdf';

        // Render PDF dan buka di tab baru
        return $pdf->stream($filename, array('Attachment' => 0))->withHeaders([
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    public function exportExcelmanageArisan()
    {
        return Excel::download(new ManageArisanExport, 'data-arisanku.xlsx');
    }

    public function detailArisan($uuid)
    {
        $arisan = Arisan::with('members')->where('uuid', $uuid)->firstOrFail();
        // $arisan = Arisan::findOrFail($id);
        // dd($arisans);

        return view('arisan.detail-arisan', ['active' => 'list-arisan'], compact('arisan'));
    }

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
            'id_user' => 'required|integer',
            'deskripsi' => 'required|string',
            'start_date' => 'required|date',
            'max_member' => 'required|integer',
            'deposit_frequency' => 'required|in:1,2,4',
            'payment_amount' => 'required|string',
            'img_arisan' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'nama_pemilik_rekening' => 'required|string|max:255',
            'fee_admin' => 'required|string|max:255',
        ]);

        if ($request->hasFile('img_arisan')) {
            $img_arisanPath = $request->file('img_arisan')->store('arisan_images', 'public');
        }

        $arisan = new Arisan();
        // $arisan->uuid = Str::uuid();
        // $arisan->nama_arisan = $request->input('nama_arisan');
        // $arisan->start_date = $request->input('start_date');
        // $arisan->end_date = $request->input('end_date');
        $arisan->uuid = Str::uuid();
        $arisan->nama_arisan = $request->input('nama_arisan');
        $arisan->deskripsi = $request->input('deskripsi');
        $arisan->start_date = \Carbon\Carbon::parse($request->input('start_date'));
        $arisan->status = 0; // Status awal (tidak aktif)
        $arisan->active = 0; // Atur active sesuai kebutuhan
        $arisan->max_member = $request->input('max_member');
        $arisan->deposit_frequency = $request->input('deposit_frequency');
        // $arisan->payment_amount = $request->input('payment_amount');
        $paymentAmount = preg_replace("/[^0-9]/", "", $request->input('payment_amount'));
        $arisan->payment_amount = $paymentAmount;
        $arisan->id_user = $request->input('id_user');
        $arisan->nama_bank = $request->input('nama_bank');
        $arisan->no_rekening = $request->input('no_rekening');
        $arisan->nama_pemilik_rekening = $request->input('nama_pemilik_rekening');
        $arisan->fee_admin = $request->input('fee_admin');

        // Store the image path in the database if an image was uploaded
        if (isset($img_arisanPath)) {
            $arisan->img_arisan = $img_arisanPath;
        }

        $arisan->save();


        return redirect('/data-arisan')->with('success', 'Data Owner telah ditambahkan.');
    }

    public function editArisan($uuid)
    {
        $arisan = Arisan::where('uuid', $uuid)->firstOrFail();
        // $arisan = Arisan::where('id_arisan', $id)->first();
        return view('arisan.edit-arisan', ['active' => 'manage-arisan', 'arisan' => $arisan]);
    }

    public function processEditArisan(Request $request, $uuid)
    {
        // $arisan = Arisan::where('id_arisan', $id)->first();
        $arisan = Arisan::where('uuid', $uuid)->first();

        $request->validate([
            'nama_arisan' => 'required|string|max:255',
            // 'id_user' => 'required|integer',
            'deskripsi' => 'required|string',
            'start_date' => 'required|date',
            'max_member' => 'required|integer',
            'deposit_frequency' => 'required|in:1,2,4',
            'payment_amount' => 'required|string',
            'img_arisan' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'nama_pemilik_rekening' => 'required|string|max:255',
            'fee_admin' => 'required|string|max:255',
        ]);

        if (!$arisan->uuid) {
            $arisan->uuid = Str::uuid();
        }
        $arisan->nama_arisan = $request->input('nama_arisan');
        // $arisan->id_user = $request->input('id_user');
        $arisan->deskripsi = $request->input('deskripsi');
        $arisan->start_date = $request->input('start_date');
        $arisan->max_member = $request->input('max_member');
        $arisan->deposit_frequency = $request->input('deposit_frequency');
        $arisan->payment_amount = $request->input('payment_amount');
        $arisan->nama_bank = $request->input('nama_bank');
        $arisan->no_rekening = $request->input('no_rekening');
        $arisan->nama_pemilik_rekening = $request->input('nama_pemilik_rekening');
        $arisan->fee_admin = $request->input('fee_admin');

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
        // dd($arisan);
        return redirect('/data-arisan')->with('success', 'Perubahan Owner telah disimpan.');
    }

    public function editArisanOwner($uuid)
    {
        $user = auth()->user();
        $arisan = Arisan::where('uuid', $uuid)->where('id_user', $user->id)->firstOrFail();
        // dd($arisan);
        return view('arisan.edit-arisan-owner', ['active' => 'manage-arisan', 'arisan' => $arisan]);
    }

    public function processEditArisanOwner(Request $request, $uuid)
    {
        $user = auth()->user();
        // $arisan = Arisan::where('id_arisan', $id)->first();
        $arisan = Arisan::where('uuid', $uuid)->where('id_user', $user->id)->first();

        $request->validate([
            'nama_arisan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'start_date' => 'required|date',
            'max_member' => 'required|integer',
            'deposit_frequency' => 'required|in:1,2,4',
            'payment_amount' => 'required|string',
            'img_arisan' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'nama_pemilik_rekening' => 'required|string|max:255',
            'fee_admin' => 'required|string|max:255',
        ]);

        if (!$arisan->uuid) {
            $arisan->uuid = Str::uuid();
        }
        $arisan->nama_arisan = $request->input('nama_arisan');
        // $arisan->id_user = $request->input('id_user');
        $arisan->deskripsi = $request->input('deskripsi');
        $arisan->start_date = $request->input('start_date');
        $arisan->max_member = $request->input('max_member');
        // $arisan->deposit_frequency = $request->input('deposit_frequency');
        $months = $this->convertDepositFrequencyToMonths($request->input('deposit_frequency'));
        $arisan->deposit_frequency = $months;
        $arisan->payment_amount = $request->input('payment_amount');
        $arisan->nama_bank = $request->input('nama_bank');
        $arisan->no_rekening = $request->input('no_rekening');
        $arisan->nama_pemilik_rekening = $request->input('nama_pemilik_rekening');
        $arisan->fee_admin = $request->input('fee_admin');

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
        // dd($arisan);
        return redirect('/manage-arisan')->with('success', 'Perubahan Arisan telah disimpan.');
    }

    public function deleteArisanOwner($uuid)
    {
        // Find the Arisan using the UUID
        $arisan = Arisan::where('uuid', $uuid)->first();

        // Check if the Arisan exists
        if (!$arisan) {
            return redirect('/manage-arisan')->with('error', 'Arisan tidak ditemukan.');
        }

        // Delete the Arisan
        $arisan->delete();

        return redirect('/manage-arisan')->with('success', 'Data Arisan telah dihapus.');
    }

    public function deleteArisan($uuid)
    {
        $arisan = Arisan::where('uuid', $uuid)->first();

        if (!$arisan) {
            return redirect('/data-arisan')->with('error', 'Arisan tidak ditemukan.');
        }

        $memberArisans = MemberArisan::where('id_arisan', $arisan->id_arisan)->get();

        if (!$memberArisans->isEmpty()) {
            $memberArisans->each->delete();
        }

        $arisan->delete();

        return redirect('/data-arisan')->with('success', 'Data Arisan dan semua anggota telah dihapus.');
    }


    public function addArisanOwner()
    {
        $id = Auth::user()->id;
        $users = User::findOrFail($id);

        // $users = User::all();

        return view('arisan.add-arisan-owner', ['active' => 'manage-arisan', 'users' => $users]);
    }

    public function processAddArisanOwner(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nama_arisan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'start_date' => 'required|date',
            'max_member' => 'required|integer',
            'deposit_frequency' => 'required|in:1,2,4',
            'payment_amount' => 'required|string',
            'img_arisan' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'nama_pemilik_rekening' => 'required|string|max:255',
            'fee_admin' => 'required|string|max:255',
        ]);

        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Simpan data arisan ke dalam database dengan status awal 0 (tidak aktif)
        $arisan = new Arisan();
        $arisan->uuid = Str::uuid();
        $arisan->nama_arisan = $request->input('nama_arisan');
        $arisan->deskripsi = $request->input('deskripsi');
        $arisan->start_date = \Carbon\Carbon::parse($request->input('start_date'));
        $arisan->status = 0; // Status awal (tidak aktif)
        $arisan->active = 0; // Atur active sesuai kebutuhan
        $arisan->max_member = $request->input('max_member');
        $arisan->deposit_frequency = $request->input('deposit_frequency');

        // $months = $this->convertDepositFrequencyToMonths($request->input('deposit_frequency'));
        // $arisan->deposit_frequency = $months;

        $paymentAmount = preg_replace("/[^0-9]/", "", $request->input('payment_amount'));
        $arisan->payment_amount = $paymentAmount;
        $arisan->id_user = $userId;
        $arisan->nama_bank = $request->input('nama_bank');
        $arisan->no_rekening = $request->input('no_rekening');
        $arisan->nama_pemilik_rekening = $request->input('nama_pemilik_rekening');
        $arisan->fee_admin = $request->input('fee_admin');

        // Upload gambar jika ada
        if ($request->hasFile('img_arisan')) {
            $imagePath = $request->file('img_arisan')->store('arisan_images', 'public');
            $arisan->img_arisan = $imagePath;
        }

        $arisan->save();
        // dd($arisan);

        return redirect('/manage-arisan')->with('success', 'Arisan berhasil ditambahkan');
    }

    public function startArisan($uuid)
    {
        $arisan = Arisan::where('uuid', $uuid)->firstOrFail();
        $userId = Auth::id();

        if ($arisan->id_user == $userId) {
            $arisan->status = 2;

            $memberCount = MemberArisan::where('id_arisan', $arisan->id_arisan)->count();
            $depositFrequency = $arisan->deposit_frequency;
            $startDate = \Carbon\Carbon::parse($arisan->start_date);

            // Set tanggal awal pada hari pertama setiap bulan
            $adjustedStartDate = $startDate;

            // Inisialisasi tanggal akhir
            $endDate = $adjustedStartDate->copy();

            // Periksa nilai $depositFrequency
            if ($depositFrequency == 1 || $depositFrequency == 2) {
                // Jika $depositFrequency adalah 1 atau 2, gunakan addWeeks
                $endDate->addWeeks($depositFrequency * $memberCount);
            } elseif ($depositFrequency == 4) {
                // Jika $depositFrequency adalah 4, gunakan 1 bulan * $memberCount
                $endDate->addMonths($memberCount);

                // Set tanggal akhir sama dengan tanggal mulai
                $endDate->day($adjustedStartDate->day);
            }

            $arisan->end_date = $endDate;

            $arisan->save();

            return redirect('/manage-arisan')->with('success', 'Arisan berhasil diaktifkan');
        } else {
            return redirect('/manage-arisan')->with('error', 'Anda tidak memiliki izin untuk mengaktifkan arisan ini');
        }
    }



    public function arisanku(Request $request)
    {
        try {
            $search = $request->input('search', '');

            $user = Auth::user();

            $query = Arisan::query()
                ->join('member_arisans', 'arisans.id_arisan', '=', 'member_arisans.id_arisan')
                ->where('member_arisans.id_user', $user->id)
                ->orderBy('arisans.created_at', 'desc');

            if ($search) {
                $query->where('nama_arisan', 'like', "%$search%");
            }

            $arisans = $query->paginate(32);

            return view('arisan.arisanku', ['active' => 'arisanku', 'search' => $search, 'arisans' => $arisans]);
        } catch (Exception $e) {
            // Tangani kesalahan di sini
            report($e); // Laporkan kesalahan ke sistem logging Laravel
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }

    public function listArisan(Request $request)
    {
        $search = $request->input('search', '');

        $query = Arisan::query();

        if ($search) {
            $query->where('nama_arisan', 'like', "%$search%");
        }

        $arisans = $query->paginate(32);

        return view('arisan.list-arisan', ['active' => 'list-arisan', 'search' => $search, 'arisans' => $arisans]);
    }

    public function joinArisan(Arisan $arisan)
    {
        $user = auth()->user();

        if ($user->role !== 0) {
            return redirect()->route('dashboard')->with('error', 'Hanya member yg bisa bergabung arisan!');
        }

        if (!$arisan->members()->where('id_user', $user->id)->exists()) {
            if ($arisan->members()->count() >= $arisan->max_member) {
                return redirect()->route('list-arisan')->with('error', 'Maaf, Arisan telah penuh. Silahkan bergabung kembali di periode selanjutnya.');
            }

            $arisan->members()->attach($user);
            return redirect()->route('list-arisan')->with('success', 'Berhasil bergabung!');
        } else {
            return redirect()->route('list-arisan')->with('error', 'Anda sudah bergabung!.');
        }
    }


    public function search(Request $request)
    {
        $search = $request->input('search', '');

        $query = Arisan::query();

        if ($search) {
            $query->where('nama_arisan', 'like', "%$search%");
        }

        $arisans = $query->paginate(32);

        // Sanitasi data yang akan ditampilkan
        $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');

        return view('arisan.list-arisan', ['active' => 'list-arisan', 'search' => $search, 'arisans' => $arisans]);
    }

    public function pageArisan($uuid)
    {

        // $arisan = Arisan::where('id_arisan', $id)->first();
        $arisan = Arisan::with('members')->where('uuid', $uuid)->firstOrFail();
        return view('arisan.page-arisan', ['active' => 'manage-arisan', 'arisan' => $arisan]);
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
