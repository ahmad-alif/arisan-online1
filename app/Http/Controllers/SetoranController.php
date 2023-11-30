<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Arisan;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SetoranController extends Controller
{
    public function index(Request $request)
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
                ->latest()
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
        // $arisan = Arisan::where('uuid', $uuid)->first();
        $arisan = Arisan::where('uuid', '=', $uuid)->first();

        // Buat invoice baru
        $invoice = new Invoice();
        $invoice->invoice_number = $this->generateInvoiceNumber();
        $invoice->uuid = $arisan->uuid;
        $invoice->id_user = $id_user;
        $invoice->nama_bank = $arisan->nama_bank;
        $invoice->no_rekening = $arisan->no_rekening;
        $invoice->nama_pemilik_rekening = $arisan->nama_pemilik_rekening;

        // Hitung total berdasarkan payment_amount dan fee_admin
        // $total = floatval($arisan->payment_amount) + floatval($arisan->fee_admin);
        // $invoice->total = number_format($total, 2, '.', '');
        $total = floatval($arisan->payment_amount) + floatval($arisan->fee_admin);
        $invoice->total = intval($total); // Convert total to integer

        $invoice->save();
        // dd($invoice);

        // Tampilkan pesan sukses atau arahkan kembali ke halaman sebelumnya
        // return redirect()->back()->with('success', 'Invoice berhasil dibuat');
        // $view = view('modals.invoice_modal', ['invoice' => $invoice])->render();
        // return response()->json(['html' => $view]);
        // return $invoice;
        return redirect()->route('setoran', ['uuid' => $uuid])->with('success', 'Invoice berhasil dibuat');
    }

    private function generateInvoiceNumber()
    {
        $year = now()->format('Y');
        $month = now()->format('m');
        $day = now()->format('d');
        $randomDigits = mt_rand(100000, 999999); // Angka acak 6 digit

        return $year . $month . $day . $randomDigits;
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

    public function uploadSetoran($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();
        return view('setoran.upload', ['invoice' => $invoice]);
    }

    public function processUploadSetoran(Request $request, $invoice_number)
    {
        try {
            // Validasi request
            $request->validate([
                'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $invoice = Invoice::where('invoice_number', $invoice_number)->first();

            // Proses upload dan simpan bukti transfer
            $image = $request->file('bukti_transfer');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/bukti_transfer', $imageName);

            // Simpan informasi bukti transfer ke database
            $invoice->bukti_transfer = $imageName;
            $invoice->save();

            return redirect('/setoran')->with('success', 'Bukti setoran berhasil diunggah.');
        } catch (Exception $e) {
            // Tangani kesalahan di sini
            report($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }
}
