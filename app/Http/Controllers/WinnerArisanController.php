<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Arisan;
use App\Models\WinnerArisan;
use Illuminate\Http\Request;

class WinnerArisanController extends Controller
{
    // public function drawWinner($arisanId)
    // {
    //     return view('arisan.winner-arisan', ['active' => 'manage-arisan', 'arisanId' => $arisanId]);
    // }

    // public function showWinner($id)
    // {
    //     $arisan = Arisan::findOrFail($id);

    //     // Filter pemenang berdasarkan arisan
    //     $winners = WinnerArisan::where('id_arisan', $arisan->id_arisan)->with('user')->get();

    //     return view('arisan.winner-arisan', ['active' => 'manage-arisan'], compact('arisan', 'winners'));
    // }

    // public function showWinner($id)
    // {
    //     // $arisan = Arisan::findOrFail($id);
    //     // $members = $arisan->members;

    //     // return view('arisan.winner-arisan', ['active' => 'manage-arisan'], compact('arisan', 'members'));
    //     // $arisan = Arisan::findOrFail($id);
    //     // $members = $arisan->members;

    //     // // Ambil pemenang secara acak dari member arisan
    //     // $selectedWinner = $members->random();

    //     $arisan = Arisan::findOrFail($id);

    //     // Ambil ID pengguna-pemenang sebelumnya
    //     $previousWinners = WinnerArisan::where('id_arisan', $arisan->id_arisan)->pluck('id_user')->toArray();

    //     // Ambil pemenang secara acak dari member arisan, sambil memastikan tidak mengulangi pemenang sebelumnya
    //     $selectedWinner = $arisan->members->reject(function ($member) use ($previousWinners) {
    //         return in_array($member->id, $previousWinners);
    //     })->random();

    //     return view('arisan.winner-arisan', ['active' => 'manage-arisan'], compact('arisan', 'selectedWinner'));
    // }

    // public function drawWinner(Request $request, $id)
    // {
    //     // Validasi form, pastikan hanya owner yang bisa mengakses fungsi ini
    //     $this->validate($request, [
    //         'winner_id' => 'required|exists:users,id',
    //     ]);

    //     $arisan = Arisan::findOrFail($id);
    //     $winnerId = $request->input('winner_id');

    //     // Tambahkan pemenang ke tabel pemenang_arisan
    //     WinnerArisan::create([
    //         'id_arisan' => $arisan->id_arisan,
    //         'id_user' => $winnerId,
    //     ]);

    //     // Tandai arisan sebagai sudah diundi
    //     $arisan->update(['status' => 2]);

    //     // Cek apakah masih ada anggota yang dapat diundi
    //     $remainingMembers = $arisan->members->count();

    //     if ($remainingMembers == 0) {
    //         // Jika tidak ada anggota yang tersisa, ubah status arisan menjadi 3 (selesai)
    //         $arisan->update(['status' => 3]);
    //     }

    //     return redirect()->route('manage-arisan')->with('success', 'Pemenang Arisan berhasil dipilih.');
    // }

    // public function showWinner($id)
    // {
    //     $arisan = Arisan::findOrFail($id);

    //     // Ambil ID pengguna-pemenang sebelumnya
    //     $previousWinners = WinnerArisan::where('id_arisan', $arisan->id_arisan)->pluck('id_user')->toArray();

    //     // Ambil pemenang secara acak dari member arisan, sambil memastikan tidak mengulangi pemenang sebelumnya
    //     $selectedWinner = $arisan->members->reject(function ($member) use ($previousWinners) {
    //         return in_array($member->id, $previousWinners);
    //     })->random();

    //     // Cek apakah hanya tersisa satu id_user
    //     $remainingUsers = count($arisan->members) - count($previousWinners);

    //     return view('arisan.winner-arisan', ['active' => 'manage-arisan'], compact('arisan', 'selectedWinner', 'remainingUsers'));
    // }

    // public function drawWinner(Request $request, $id)
    // {
    //     // Validasi form, pastikan hanya owner yang bisa mengakses fungsi ini
    //     $this->validate($request, [
    //         'winner_id' => 'required|exists:users,id',
    //     ]);

    //     $arisan = Arisan::findOrFail($id);
    //     $winnerId = $request->input('winner_id');

    //     // Tambahkan pemenang ke tabel pemenang_arisan
    //     WinnerArisan::create([
    //         'id_arisan' => $arisan->id_arisan,
    //         'id_user' => $winnerId,
    //     ]);

    //     // Tandai arisan sebagai sudah diundi
    //     $arisan->update(['status' => 2]);

    //     // Jika hanya tersisa satu id_user, ubah status menjadi 3
    //     if ($request->input('remaining_users') == 1) {
    //         $arisan->update(['status' => 3]);
    //     }

    //     return redirect()->route('manage-arisan')->with('success', 'Pemenang Arisan berhasil dipilih.');
    // }

    public function showWinner($uuid)
    {
        $arisan = Arisan::where('uuid', $uuid)->firstOrFail();

        // Ambil ID pengguna-pemenang sebelumnya
        $previousWinners = WinnerArisan::where('id_arisan', $arisan->id_arisan)->pluck('id_user')->toArray();

        // Ambil pemenang secara acak dari member arisan, sambil memastikan tidak mengulangi pemenang sebelumnya
        $selectedWinner = $arisan->members->reject(function ($member) use ($previousWinners) {
            return in_array($member->id, $previousWinners);
        })->random();

        // Cek apakah hanya tersisa satu id_user
        $remainingUsers = count($arisan->members) - count($previousWinners);

        return view('arisan.winner-arisan', ['active' => 'manage-arisan'], compact('arisan', 'selectedWinner', 'remainingUsers'));
    }

    public function drawWinner(Request $request, $uuid)
    {
        // Validasi form, pastikan hanya owner yang bisa mengakses fungsi ini
        $this->validate($request, [
            'winner_id' => 'required|exists:users,id',
        ]);

        $arisan = Arisan::where('uuid', $uuid)->firstOrFail();
        $winnerId = $request->input('winner_id');
        $winnerUser = User::findOrFail($winnerId);

        // Tambahkan pemenang ke tabel pemenang_arisan
        WinnerArisan::create([
            'id_arisan' => $arisan->id_arisan,
            'uuid' => $arisan->uuid,
            'id_user' => $winnerId,
            'username' => $winnerUser->username,
            'name' => $winnerUser->name,
            'email' => $winnerUser->email,
            'nohp' => $winnerUser->nohp,
            'created_at' => Carbon::now(),
        ]);

        // Tandai arisan sebagai sudah diundi
        $arisan->update(['status' => 2]);

        // Jika hanya tersisa satu id_user, ubah status menjadi 3
        if ($request->input('remaining_users') == 1) {
            $arisan->update(['status' => 3]);
        }

        return redirect()->route('detail-arisan', ['uuid' => $uuid])->with('success', 'Pemenang Arisan berhasil dipilih.');
    }


    // public function drawWinner(Request $request, $id)
    // {
    //     // Validasi form, pastikan hanya owner yang bisa mengakses fungsi ini
    //     $this->validate($request, [
    //         'winner_id' => 'required|exists:users,id',
    //     ]);

    //     $arisan = Arisan::findOrFail($id);
    //     $winnerId = $request->input('winner_id');

    //     // Tambahkan pemenang ke tabel pemenang_arisan
    //     WinnerArisan::create([
    //         'id_arisan' => $arisan->id_arisan,
    //         'id_user' => $winnerId,
    //     ]);

    //     // Tandai arisan sebagai sudah diundi
    //     $arisan->update(['status' => 2]);
    //     // dd($arisan);

    //     return redirect()->route('manage-arisan')->with('success', 'Pemenang Arisan berhasil dipilih.');
    // }

    // public function showWinner($id)
    // {
    //     $arisan = Arisan::findOrFail($id);
    //     $winners = WinnerArisan::where('id_arisan', $arisan->id_arisan)->with('user')->get();

    //     return view('arisan.winner-arisan', [
    //         'active' => 'manage-arisan',
    //         'arisan' => $arisan,
    //         'winners' => $winners,
    //         // 'arisanId' => $arisan->id_arisan,
    //     ]);
    // }

    // public function drawWinner($id)
    // {
    //     // Ambil arisan
    //     $arisan = Arisan::findOrFail($id);

    //     // Pastikan ada anggota arisan yang berpartisipasi
    //     if ($arisan->members->isEmpty()) {
    //         return redirect()->back()->with('error', 'Tidak ada anggota arisan yang berpartisipasi.');
    //     }

    //     // Ambil satu anggota secara acak sebagai pemenang
    //     $winner = $arisan->members->random();

    //     // Simpan pemenang ke dalam tabel pemenang_arisan
    //     WinnerArisan::create([
    //         'id_arisan' => $arisan->id_arisan,
    //         'id_user' => $winner->id,
    //     ]);

    //     // Tandai bahwa pemenang sudah diundi
    //     $arisan->update(['winner_drawn' => true]);

    //     return redirect()->route('manage-arisan')->with('success', 'Pemenang arisan berhasil diundi.');
    // }

    // public function drawWinner($id)
    // {
    //     $arisan = Arisan::findOrFail($id);

    //     // Pastikan pemenang belum diundi sebelumnya
    //     if (!$arisan->winner_drawn) {
    //         // Ambil semua member arisan
    //         $members = $arisan->members;

    //         // Acak dan pilih pemenang
    //         $winner = $members->shuffle()->first();

    //         // Simpan pemenang ke dalam tabel pemenang_arisan
    //         WinnerArisan::create([
    //             'id_arisan' => $arisan->id_arisan,
    //             'id_user' => $winner->id_user,
    //         ]);

    //         // Update status arisan bahwa pemenang sudah diundi
    //         $arisan->update(['winner_drawn' => true]);

    //         return redirect()->route('winner-arisan', ['id' => $arisan->id_arisan])
    //             ->with('success', 'Pemenang berhasil diundi.');
    //     }

    //     return redirect()->route('winner-arisan', ['id' => $arisan->id_arisan])
    //         ->with('error', 'Pemenang sudah diundi sebelumnya.');
    // }

    // public function selectWinner($id)
    // {
    //     // Your logic to select a winner goes here
    //     $winnerName = "John Doe"; // Replace this with your actual logic

    //     return response()->json(['winner' => $winnerName]);
    // }
}
