<?php

namespace App\Http\Controllers;

use App\Models\Arisan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $arisans = Arisan::with('user')->get();
        // $arisans = Arisan::all();

        $rekomendasiArisans = Arisan::with('user')
            ->join('member_arisans', 'arisans.id_arisan', '=', 'member_arisans.id_arisan')
            ->selectRaw('arisans.*, COUNT(member_arisans.id_arisan) as total_members')
            ->groupBy('arisans.id_arisan')
            ->orderBy('total_members', 'desc')
            ->take(10) // Ambil 10 arisan rekomendasi teratas
            ->get();

        // List arisan terbaru
        $terbaruArisans = Arisan::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10) // Ambil 10 arisan terbaru
            ->get();

        return view('home', ['arisans' => $arisans, 'rekomendasiArisans' => $rekomendasiArisans, 'terbaruArisans' => $terbaruArisans]);
    }
}
