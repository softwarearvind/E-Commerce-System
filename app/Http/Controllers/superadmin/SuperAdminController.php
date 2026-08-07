<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard');
    }

    public function usersIndex()
    {
         $users = User::role('customer')->paginate(5);
          return view('superadmin.users.index', compact('users'));
    }

    public function vindoer()
    {
        $vendors = User::role('vendor')->latest()->paginate(5);
         return view('superadmin.vendors.index', compact('vendors'));
    }

 public function updateStatus(Request $request,$id)
{
    $vendor = User::findOrFail($id);

    $vendor->status = $request->status;
    $vendor->save();


    return response()->json([
        'success'=>true,
        'message'=>'Vendor status updated successfully'
    ]);
}
}
