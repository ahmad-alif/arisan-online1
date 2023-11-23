<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arisan;
use App\Models\MemberArisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberArisanController extends Controller
{
    // public function index()
    // {
    //     // $memberArisans = MemberArisan::with('arisan.user')->get();
    //     // return view('member.index', ['active' => 'manage-member'], compact('memberArisans'));
    //     $ownerUserId = Auth::id();

    //     // $memberArisans = MemberArisan::whereHas('arisan', function ($query) use ($ownerUserId) {
    //     //     $query->where('id_user', $ownerUserId);
    //     // })->with('arisan.user')->get();
    //     $memberArisans = MemberArisan::whereHas('arisan', function ($query) use ($ownerUserId) {
    //         $query->where('id_user', $ownerUserId);
    //     })->with('user')->get();

    //     return view('member.index', ['active' => 'manage-member'], compact('memberArisans'));
    //     // dd($memberArisans)->id_arisan;
    // }
    public function index()
    {
        $ownerUserId = Auth::id();
        $members = User::whereHas('arisans', function ($query) use ($ownerUserId) {
            $query->where('arisans.id_user', $ownerUserId);
        })->distinct()->get();

        return view('member.index', ['active' => 'manage-member'], compact('members'));
    }


    // public function index()
    // {
    //     $ownerUserId = Auth::id();

    //     $memberArisans = MemberArisan::whereIn('id_arisan', function ($query) use ($ownerUserId) {
    //         $query->select('id_arisan')
    //             ->from('arisans')
    //             ->where('id_user', $ownerUserId);
    //     })->with('user')->paginate(10);

    //     return view('member.index', ['active' => 'manage-member'], compact('memberArisans'));
    // }
    // public function showDetail($id)
    // {
    //     $user = User::find($id);
    //     $arisan = MemberArisan::where('id_user', $id)->with('arisan')->get();

    //     return view('member.detail', compact('user', 'arisan'));
    // }
    // public function showDetail($id)
    // {
    //     $user = User::find($id);
    //     $arisan = Arisan::with('members')->where('id_user', $id)->get();

    //     return view('member.detail', compact('user', 'arisan'));
    // }
    public function showDetail($id)
    {
        $user = User::find($id);
        $arisan = Arisan::with('members')->where('arisans.id_user', $id)->get();

        return view('member.detail', compact('user', 'arisan'));
    }
}
