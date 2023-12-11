<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Arisan;
use App\Models\Invoice;
use App\Models\Setoran;
use Illuminate\Http\Request;
use App\Exports\SetoranExport;
use Barryvdh\DomPDF\PDF as DomPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SetoranController extends Controller
{
    private function clearExpiredInvoices($uuid)
    {
        Invoice::where('status', 0)->where('uuid', $uuid)->where('expired_at', '<', now())->delete();
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('search', '');

            $user = Auth::user();

            $query = Arisan::query()
                ->with('cekSetoran')
                ->join('member_arisans', 'arisans.id_arisan', '=', 'member_arisans.id_arisan')
                ->where('member_arisans.id_user', $user->id)
                ->orderBy('arisans.created_at', 'desc');

            if ($search) {
                $query->where('nama_arisan', 'like', "%$search%");
            }

            $arisans = $query->paginate(32);

            return view('setoran.index', ['active' => 'setoran', 'search' => $search, 'arisans' => $arisans]);
        } catch (Exception $e) {
            // Tangani kesalahan di sini
            report($e); // Laporkan kesalahan ke sistem logging Laravel
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }

    public function setoran($uuid)
    {
        try {
            $id_user = auth()->user()->id;
            $arisan = Arisan::where('uuid', $uuid)->with('setorans', 'invoices')->firstOrFail();

            // Ambil invoice terbaru dengan UUID arisan dan ID user
            $invoice = Invoice::where('uuid', $arisan->uuid)
                ->where('id_user', $id_user)
                ->latest('created_at')
                ->first();

            return view('setoran.setoran', ['active' => 'setoran', 'arisan' => $arisan, 'invoice' => $invoice]);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Arisan tidak ditemukan');
        }
    }

    public function createInvoice($uuid)
    {
        $id_user = auth()->user()->id;

        // Temukan Arisan berdasarkan UUID
        $arisan = Arisan::where('uuid', $uuid)->first();

        // Cek status Arisan
        if ($arisan) {
            if ($arisan->status == 2) {
                // Buat invoice baru
                $invoice = new Invoice();
                $invoice->invoice_number = $this->generateInvoiceNumber();
                $invoice->uuid = $arisan->uuid;
                $invoice->id_user = $id_user;
                $invoice->nama_bank = $arisan->nama_bank;
                $invoice->no_rekening = $arisan->no_rekening;
                $invoice->nama_pemilik_rekening = $arisan->nama_pemilik_rekening;

                $total = floatval($arisan->payment_amount) + floatval($arisan->fee_admin);
                $randomDiscount = rand(1, 999);
                $total -= $randomDiscount;
                $invoice->total = intval($total);
                $invoice->status = 0;
                $invoice->expired_at = now()->addMinutes(1);

                $invoice->save();

                $this->clearExpiredInvoices($uuid);

                return redirect()->route('setoran', ['uuid' => $uuid])->with('success', 'Invoice berhasil dibuat');
            } elseif ($arisan->status == 3) {
                return redirect()->route('setoran', ['uuid' => $uuid])->with('error', 'Arisan telah selesai.');
            } else {
                return redirect()->route('setoran', ['uuid' => $uuid])->with('error', 'Arisan belum dimulai.');
            }
        }

        return redirect()->route('setoran', ['uuid' => $uuid])->with('error', 'Arisan tidak ditemukan.');
    }


    private function generateInvoiceNumber()
    {
        $year = now()->format('Y');
        $month = now()->format('m');
        $day = now()->format('d');
        $randomDigits = mt_rand(100000, 999999); // Angka acak 6 digit

        return $year . $month . $day . $randomDigits;
    }

    public function cetakPdfInvoice($uuid)
    {
        $invoice = Invoice::where('uuid', $uuid)->first();

        if (!$invoice) {
            abort(404);
        }

        $pdf = app(DomPDF::class)->loadView('pdf.invoice', compact('invoice'));

        return $pdf->stream('invoice.pdf');
    }

    public function dataSetoran()
    {
        $setoranData = Setoran::paginate(25);

        return view('setoran.manage-setoran', ['active' => 'manage-setoran', 'setoranData' => $setoranData]);

        // $userId = Auth::id();

        // // Retrieve arisan UUIDs created by the owner
        // $arisanUuids = Arisan::where('id_user', $userId)->pluck('uuid');

        // // Assuming you want to retrieve paginated setoran data related to those arisan UUIDs
        // $setoranData = Setoran::whereIn('uuid', $arisanUuids)->paginate(10);

        // return view('setoran.manage-setoran', ['active' => 'manage-setoran', 'setoranData' => $setoranData]);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search', '');

        $query = Setoran::query();

        if ($searchQuery) {
            $query->where('invoice_number', 'like', "%$searchQuery%");
        }

        $setoranData = $query->paginate(25);

        $isEmpty = $setoranData->isEmpty();

        return view('setoran.manage-setoran', [
            'active' => 'manage-setoran',
            'setoranData' => $setoranData,
            'isEmpty' => $isEmpty,
            'searchQuery' => $searchQuery
        ]);
    }

    public function searchOwner(Request $request)
    {
        $userId = Auth::id();

        $arisanUuids = Arisan::where('id_user', $userId)->pluck('uuid');

        $query = Setoran::whereIn('uuid', $arisanUuids);

        $searchQuery = $request->input('search', '');
        if ($searchQuery) {
            $query->where('invoice_number', 'like', "%$searchQuery%");
        }

        $setoranData = $query->paginate(10);

        return view('setoran.manage-setoran', [
            'active' => 'manage-setoran',
            'setoranData' => $setoranData,
            'searchQuery' => $searchQuery,
        ]);
    }

    public function manageSetoran()
    {
        // $setoranData = Setoran::paginate(25);

        // return view('setoran.manage-setoran', ['active' => 'manage-setoran', 'setoranData' => $setoranData]);
        $userId = Auth::id();

        // Retrieve arisan UUIDs created by the owner
        $arisanUuids = Arisan::where('id_user', $userId)->pluck('uuid');

        // Assuming you want to retrieve paginated setoran data related to those arisan UUIDs
        $setoranData = Setoran::whereIn('uuid', $arisanUuids)->paginate(10);

        return view('setoran.manage-setoran', ['active' => 'manage-setoran', 'setoranData' => $setoranData]);
    }

    public function updateSetoranStatus(Setoran $setoran)
    {
        try {
            $setoran->update(['status' => 1]);

            return redirect()->back()->with('success', 'Setoran berhasil diverifikasi.');
        } catch (\Exception $e) {
            // Log the exception or handle it in an appropriate way
            return redirect()->back()->with('error', 'Gagal verifikasi setoran');
        }
    }


    public function exportSetoran()
    {
        // Get the currently logged-in user's ID
        $userId = Auth::id();

        // Retrieve arisan UUIDs created by the owner
        $arisanUuids = Arisan::where('id_user', $userId)->pluck('uuid');

        // Retrieve setoran data related to those arisan UUIDs
        $setoranData = Setoran::whereIn('uuid', $arisanUuids)->get();

        // Export data to Excel using SetoranExport class
        return Excel::download(new SetoranExport($setoranData), 'data-setoran.xlsx');
    }

    public function riwayat()
    {
        $userId = Auth::id();

        $riwayatSetoran = Setoran::whereHas('invoice', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->get();

        $arisanData = Arisan::all();

        return view('setoran.riwayat', ['active' => 'riwayat-setoran', 'riwayatSetoran' => $riwayatSetoran, 'arisanData' => $arisanData]);
    }

    // public function tampilInvoice($invoice_number)
    // {
    //     // Fetch the invoice details based on the invoice number
    //     $invoice = Invoice::where('invoice_number', $invoice_number)->first();

    //     // Render the invoice details view and return as JSON
    //     $view = view('modals.invoice_modal', ['invoice' => $invoice])->render();
    //     return response()->json(['html' => $view, 'invoice_number' => $invoice_number]);
    // }

    // public function createInvoice($uuid)
    // {
    //     try {
    //         // Temukan Arisan berdasarkan UUID
    //         $arisan = Arisan::where('uuid', $uuid)->firstOrFail();

    //         // Gunakan transaksi untuk memastikan konsistensi data
    //         return DB::transaction(function () use ($arisan) {
    //             try {
    //                 // Buat Invoice
    //                 $invoice = Invoice::create([
    //                     'invoice_number' => $this->generateInvoiceNumber(),
    //                     'uuid' => $arisan->uuid,
    //                     // Tambahkan informasi invoice lainnya sesuai kebutuhan
    //                 ]);

    //                 // Hubungkan Invoice dengan Arisan
    //                 $arisan->invoices()->save($invoice);
    //                 dd($arisan);
    //                 // return redirect()->back()->with('success', 'Invoice berhasil dibuat');
    //             } catch (\Exception $e) {
    //                 return redirect()->back()->with('error', 'Gagal membuat invoice');
    //             }
    //         });
    //     } catch (ModelNotFoundException $e) {
    //         return redirect()->back()->with('error', 'Arisan tidak ditemukan');
    //     }
    // }

    // private function generateInvoiceNumber()
    // {
    //     // Generate invoice number dengan format: TahunBulanTanggalRandom
    //     return date('Ymd') . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    // }

    // public function uploadSetoran($invoice_number, $uuid)
    // {
    //     $invoice = Invoice::where('invoice_number', $invoice_number)->first();
    //     $arisan = Arisan::where('uuid', $uuid)->with('setorans', 'invoices')->firstOrFail();

    //     return view('setoran.setoran', ['active' => 'setoran', 'arisan' => $arisan, 'invoice' => $invoice]);
    // }
    // public function uploadSetoran($invoice_number)
    // {
    //     $invoice = Invoice::where('invoice_number', $invoice_number)->with('setoran.arisan')->firstOrFail();

    //     // Jika Anda hanya perlu informasi arisan dari setoran terkait, Anda bisa menggunakan:
    //     $arisan = $invoice->setoran->arisan;

    //     return view('setoran.setoran', ['active' => 'setoran', 'arisan' => $arisan, 'invoice' => $invoice]);
    // }

    // public function uploadSetoran(Request $request, $invoice_number, $uuid)
    // {
    //     // try {
    //     // Validasi request
    //     $request->validate([
    //         'bukti_setoran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     $id_user = auth()->user()->id;

    //     // Temukan invoice berdasarkan nomor invoice dan uuid
    //     $invoice = Invoice::where('invoice_number', $invoice_number)
    //         ->where('uuid', $uuid)
    //         ->where('id_user', $id_user)
    //         ->first();

    //     $latestSetoran = Setoran::where('invoice_number', $invoice_number)
    //         ->where('uuid', $uuid)
    //         ->latest()
    //         ->first();

    //     // Periksa apakah invoice ditemukan
    //     if (!$invoice) {
    //         return redirect()->back()->with('error', 'Invoice tidak ditemukan.');
    //     }

    //     if ($latestSetoran) {
    //         Storage::delete('public/bukti_setoran/' . $latestSetoran->bukti_setoran);
    //     }

    //     // Proses upload dan simpan bukti setoran
    //     $image = $request->file('bukti_setoran');
    //     $imageName = time() . '.' . $image->extension();

    //     // Simpan informasi bukti setoran ke direktori penyimpanan yang telah di-link ke publik
    //     Storage::putFileAs('public/bukti_setoran', $image, $imageName);

    //     // Proses upload dan simpan bukti setoran
    //     // $image = $request->file('bukti_setoran');
    //     // $imageName = time() . '.' . $image->extension();
    //     // // $image->storeAs('public/bukti_setoran', $imageName);
    //     // Storage::putFileAs('public/bukti_setoran', $image, $imageName);

    //     // Simpan informasi bukti setoran ke database
    //     $setoran = new Setoran();
    //     $setoran->invoice_number = $invoice_number; // Gunakan invoice_number
    //     $setoran->uuid = $uuid; // Gunakan invoice_number
    //     $setoran->bukti_setoran = $imageName;
    //     $setoran->status = 1; // Sesuaikan dengan status yang sesuai
    //     $setoran->save();

    //     return redirect()->route('setoran', ['uuid' => $uuid])->with('success', 'Bukti setoran berhasil diunggah.');
    //     // } catch (Exception $e) {
    //     //     // Tangani kesalahan di sini
    //     //     report($e);
    //     //     return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
    //     // }
    // }

    public function uploadSetoran(Request $request, $invoice_number, $uuid)
    {
        try {
            // Validasi request
            $request->validate([
                'bukti_setoran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $id_user = auth()->user()->id;

            // Temukan invoice berdasarkan nomor invoice dan uuid
            $invoice = Invoice::where('invoice_number', $invoice_number)
                ->where('uuid', $uuid)
                ->where('id_user', $id_user)
                ->first();

            // Periksa apakah invoice ditemukan
            if (!$invoice) {
                return redirect()->back()->with('error', 'Invoice tidak ditemukan.');
            }

            // Periksa dan hapus setoran sebelumnya dengan invoice_number dan uuid yang sama
            Setoran::where('invoice_number', $invoice_number)
                ->where('uuid', $uuid)
                ->delete();

            // Proses upload dan simpan bukti setoran
            $image = $request->file('bukti_setoran');
            $imageName = time() . '.' . $image->extension();

            // Simpan informasi bukti setoran ke direktori penyimpanan yang telah di-link ke publik
            Storage::putFileAs('public/bukti_setoran', $image, $imageName);

            // Simpan informasi bukti setoran ke database
            $setoran = new Setoran();
            $setoran->invoice_number = $invoice_number;
            $setoran->uuid = $uuid;
            $setoran->bukti_setoran = $imageName;
            $setoran->status = 0;
            $setoran->save();

            $invoice->status = 1;
            $invoice->save();

            return redirect()->route('setoran', ['uuid' => $uuid])->with('success', 'Bukti setoran berhasil diunggah.');
        } catch (Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }


    public function processUploadSetoran(Request $request, $invoice_number, $uuid)
    {
        try {
            // Validasi request
            $request->validate([
                'bukti_setoran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Temukan invoice berdasarkan nomor invoice dan uuid
            $invoice = Invoice::where('invoice_number', $invoice_number)
                ->where('uuid', $uuid)
                ->first();

            // Periksa apakah invoice ditemukan
            if (!$invoice) {
                return redirect()->back()->with('error', 'Invoice tidak ditemukan.');
            }

            // Proses upload dan simpan bukti transfer
            $image = $request->file('bukti_setoran');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/bukti_setoran', $imageName);

            // Simpan informasi bukti transfer ke database
            $setoran = new Setoran();
            $setoran->id_invoice = $invoice->id;
            $setoran->bukti_setoran = $imageName;
            $setoran->status = 1; // Sesuaikan dengan status yang sesuai
            $setoran->save();

            return redirect()->route('setoran', ['uuid' => $uuid])->with('success', 'Bukti setoran berhasil diunggah.');
        } catch (Exception $e) {
            // Tangani kesalahan di sini
            report($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }


    // public function processUploadSetoran(Request $request, $invoice_number)
    // {
    //     // try {
    //     // Validasi request
    //     $request->validate([
    //         'bukti_setoran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     // $invoice = Invoice::where('invoice_number', $invoice_number)->first();
    //     $invoiceNumber = $request->input('invoice_number');
    //     $invoice = Invoice::where('invoice_number', $invoiceNumber)->first();

    //     // Proses upload dan simpan bukti transfer
    //     $image = $request->file('bukti_setoran');
    //     $imageName = time() . '.' . $image->extension();
    //     $image->storeAs('public/bukti_setoran', $imageName);

    //     // Simpan informasi bukti transfer ke database
    //     $setoran = new Setoran();
    //     $setoran->id_invoice = $invoice->id;
    //     $setoran->bukti_setoran = $imageName;
    //     $setoran->status = 1; // Sesuaikan dengan status yang sesuai
    //     $setoran->save();
    //     // dd($invoice);
    //     return redirect()->route('setoran', ['uuid' =>  $invoice->setoran->arisan->uuid])->with('success', 'Bukti setoran berhasil diunggah.');
    //     // } catch (Exception $e) {
    //     //     // Tangani kesalahan di sini
    //     //     report($e);
    //     //     return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
    //     // }
    // }
}
