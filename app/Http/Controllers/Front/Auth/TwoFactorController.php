<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('Front.Auth.two-factor-auth', [
            'user' => $user
        ]);
    }
}