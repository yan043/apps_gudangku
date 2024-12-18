<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

date_default_timezone_set("Asia/Makassar");

class HomeController extends Controller
{
    public function index()
    {
        if (!Session::get('is_logged_in'))
        {
            return redirect()->route('login')->withErrors(['login' => 'Harap login terlebih dahulu.']);
        }

        return view('home');
    }
}
