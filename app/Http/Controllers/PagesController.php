<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
         return view('pages.home');
    }

    public function banned()
    {
        return view('pages.banned');
    }
}
