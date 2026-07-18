<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        echo "Welcome to the Super Admin Dashboard!";
    }
}
