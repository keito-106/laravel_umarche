<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function legal()
    {
        return view('user.legal');
    }

    public function privacy()
    {
        return view('user.privacy');
    }
}
