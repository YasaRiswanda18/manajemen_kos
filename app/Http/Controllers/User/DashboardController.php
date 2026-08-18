<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penghuni;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cari data penghuni yang cocok dengan user_id yang sedang login
        $penghuni = Penghuni::with('kamar')->where('user_id', $user->id)->first();

        // Lempar datanya ke folder view 'user'
        return view('user.dashboard.index', compact('penghuni'));
    }
}