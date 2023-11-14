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

        //return view('home');
        return view('home', ['arisans' => $arisans]);
    }
}
