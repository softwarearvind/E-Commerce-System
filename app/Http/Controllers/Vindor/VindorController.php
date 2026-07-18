<?php

namespace App\Http\Controllers\Vindor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VindorController extends Controller
{
    public function index()
    {
        return view('vendor.dashboard');
    }
}
