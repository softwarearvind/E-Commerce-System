<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $courses = Course::with('category')->where('vendor_id',auth()->id())->when($request->search,function($q) use($request){
$q->where('title','like','%'.$request->search.'%');
})->when($request->category,function($q) use($request){
$q->where('course_category_id',$request->category);
})->when($request->type,function($q) use($request){
$q->where('type',$request->type);})->when($request->status,function($q) use($request){
$q->where('status',$request->status);
})->latest()->paginate(10);
$categories = CourseCategory::where('status',1)->get();
 return view('vendor.course.index',compact('courses','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CourseCategory::where('status',1)->get();
       return view('vendor.course.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([

            'title'=>'required|max:255',

            'course_category_id'=>'required',

            'thumbnail'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'description'=>'nullable',

            'price'=>'required|numeric',

            'level'=>'required',

            'type'=>'required',

            'status'=>'required',

        ]);




        $image = null;


        if($request->hasFile('thumbnail'))
        {

            $image = $request->file('thumbnail')
                ->store('courses','public');

        }





        Course::create([


            'vendor_id'=>auth()->id(),

            'course_category_id'=>$request->course_category_id,

            'title'=>$request->title,

            'slug'=>Str::slug($request->title),

            'thumbnail'=>$image,

            'description'=>$request->description,

            'price'=>$request->price,

            'level'=>$request->level,

            'type'=>$request->type,

            'status'=>$request->status,


        ]);




        return redirect() ->route('course.index')->with( 'success','Course Added Successfully'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
