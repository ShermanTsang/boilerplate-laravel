<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{


    public function index()
    {
        return view('index');
    }

    public function home()
    {
        if (Auth::check()) {
            $user = Auth::user();
        }
        return 'OK';
    }


}
