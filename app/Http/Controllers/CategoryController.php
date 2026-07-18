<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::latest()->paginate(10);
        return view('vendor.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:categories,name',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time().'_'.Str::slug($request->name).'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/categories'), $imageName);
        }

        Category::create([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'image'  => $imageName,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('categories.index')->with('success', 'Category created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
{
    return view('vendor.categories.create', compact('category'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Category $category)
{
    $request->validate([
        'name'   => 'required|string|max:255|unique:categories,name,' . $category->id,
        'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|boolean',
    ]);

    $imageName = $category->image;

    if ($request->hasFile('image')) {

        // Old image delete
        if ($category->image && File::exists(public_path('uploads/categories/' . $category->image))) {
            File::delete(public_path('uploads/categories/' . $category->image));
        }

        // New image upload
        $image = $request->file('image');

        $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/categories'), $imageName);
    }

    $category->update([
        'name'   => $request->name,
        'slug'   => Str::slug($request->name),
        'image'  => $imageName,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('categories.index')
        ->with('success', 'Category updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
{
    // Delete image if exists
    if ($category->image && File::exists(public_path('uploads/categories/' . $category->image))) {
        File::delete(public_path('uploads/categories/' . $category->image));
    }

    // Delete category
    $category->delete();

    return redirect()
        ->route('categories.index')
        ->with('success', 'Category deleted successfully.');
}
}
