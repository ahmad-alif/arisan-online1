<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifications = Notifikasi::all();
        $owners = User::with('arisans_owner')->where('role', 1)->orderBy('id', 'DESC')->paginate(10);
        return view('notifikasi.index', ['active' => 'notifikasi', 'notifications' => $notifications, 'owners' => $owners]);
    }

    public function addNotifikasi()
    {
        $notifications = Notifikasi::all();
        $usernames = User::where('role', 1)->pluck('username')->toArray();
        return view('notifikasi.add-notifikasi', ['active' => 'notifikasi', 'usernames' => $usernames, 'notifications' => $notifications]);
    }

    public function sendNotifikasi(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'owner' => [
                'required',
                Rule::exists('users', 'username')->where(function ($query) {
                    $query->where('role', 1);
                }),
            ],
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->input('owner'))->first();

        // Buat notifikasi baru
        $notifikasi = new Notifikasi();
        $notifikasi->judul = $request->input('judul');
        $notifikasi->slug = Str::slug($request->input('judul'));
        $notifikasi->isi = $request->input('isi');
        $notifikasi->id_user = $user->id;
        $notifikasi->save();
        // dd($notifikasi);

        return redirect()->route('notifikasi')->with('success', 'Notifikasi berhasil ditambahkan.');
    }

    public function editNotifikasi($slug)
    {
        $notification = Notifikasi::where('slug', $slug)->first();
        $usernames = User::where('role', 1)->pluck('username')->toArray();

        if (!$notification) {
            // Notifikasi tidak ditemukan, atur logika untuk menangani kasus ini
            return redirect()->route('notifikasi')->with('error', 'Notifikasi tidak ditemukan.');
        }

        // Logika lain yang diperlukan untuk menampilkan halaman edit
        return view('notifikasi.edit-notifikasi', ['active' => 'notifikasi', 'usernames' => $usernames, 'notification' => $notification]);
    }

    public function processEditNotifikasi(Request $request, $slug)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required',
            'owner' => 'required',
        ]);

        // Cari notifikasi berdasarkan slug
        $notification = Notifikasi::where('slug', $slug)->first();

        if (!$notification) {
            // Notifikasi tidak ditemukan, atur logika untuk menangani kasus ini
            return redirect()->route('notifikasi')->with('error', 'Notifikasi tidak ditemukan.');
        }

        // Lakukan validasi dan pembaruan notifikasi

        $notification->judul = $request->input('judul');
        $notification->slug = Str::slug($request->input('judul'));
        $notification->isi = $request->input('isi');
        // Update atribut-atribut lainnya sesuai kebutuhan

        $notification->save();

        return redirect()->route('notifikasi')->with('success', 'Notifikasi berhasil diperbarui.');
    }

    public function deleteNotifikasi($slug)
    {
        $notification = Notifikasi::where('slug', $slug)->first();

        if (!$notification) {
            abort(404);
        }

        $notification->delete();

        return redirect()->route('notifikasi')->with('success', 'Notifikasi berhasil dihapus.');
    }
}
