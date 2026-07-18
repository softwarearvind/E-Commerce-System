<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $brands = Brand::latest()->paginate(10);
         return view('vendor.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
        'name' => 'required|string|max:255|unique:brands,name',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|boolean',
    ]);

    $logoName = null;

    if ($request->hasFile('logo')) {

        $logo = $request->file('logo');

        $logoName = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();

        $logo->move(public_path('uploads/brands'), $logoName);
    }

    Brand::create([
        'name'   => $request->name,
        'slug'   => Str::slug($request->name),
        'logo'   => $logoName,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('brands.index')
        ->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Brand $brand)
{
    return view('vendor.brands.create', compact('brand'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
         $request->validate([
        'name'   => 'required|string|max:255|unique:brands,name,' . $brand->id,
        'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|boolean',
    ]);

    $logoName = $brand->logo;

    if ($request->hasFile('logo')) {

        // Delete old logo
        if ($brand->logo && File::exists(public_path('uploads/brands/' . $brand->logo))) {
            File::delete(public_path('uploads/brands/' . $brand->logo));
        }

        // Upload new logo
        $logo = $request->file('logo');

        $logoName = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();

        $logo->move(public_path('uploads/brands'), $logoName);
    }

    $brand->update([
        'name'   => $request->name,
        'slug'   => Str::slug($request->name),
        'logo'   => $logoName,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('brands.index')
        ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
