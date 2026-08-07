<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $categories = CourseCategory::latest()->paginate(10);
        return view('vendor.coursecategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('vendor.coursecategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
        'name' => 'required|unique:course_categories,name',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'description' => 'nullable',
        'status' => 'required',
    ]);


    $image = null;


    if($request->hasFile('image'))
    {
        $image = $request->file('image')->store('course-categories','public');
    }


    CourseCategory::create([

        'name'=>$request->name,
        'slug'=>\Str::slug($request->name),
        'image'=>$image,
        'description'=>$request->description,
        'status'=>$request->status,

    ]);
    return redirect()->route('categories.index')->with('success','Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseCategory $courseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $courseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseCategory $courseCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $courseCategory)
    {
        //
    }
}
