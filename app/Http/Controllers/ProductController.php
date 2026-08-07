<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $products = Product::with(['category', 'brand'])
    ->where('vendor_id', Auth::id()) // Sirf login vendor ke products
    ->when($request->search, function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('sku', 'like', '%' . $request->search . '%');
        });
    })
    ->latest()
    ->paginate(10);


    return view('vendor.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $categories = Category::where('status',1)->orderBy('name')->get();
          $brands = Brand::where('status',1)->orderBy('name')->get();
        return view('vendor.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable',
            'featured' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {

            $thumbnail = null;

            // Upload Thumbnail
            if ($request->hasFile('thumbnail')) {

                $file = $request->file('thumbnail');

                $thumbnail = time().'_'.$file->getClientOriginalName();

                $file->move(public_path('uploads/products/thumbnails'), $thumbnail);
            }

            // Save Product
            $product = Product::create([

                'vendor_id'   => Auth::id(),
                'category_id' => $request->category_id,
                'brand_id'    => $request->brand_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'sku'         => $request->sku,
                'price'       => $request->price,
                'sale_price'  => $request->sale_price,
                'stock'       => $request->stock,
                'description' => $request->description,
                'thumbnail'   => $thumbnail,
                'featured'    => $request->featured,
                'status'      => $request->status,

            ]);

            // Upload Gallery Images
            if ($request->hasFile('gallery')) {

                foreach ($request->file('gallery') as $image) {

                    $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                    $image->move(public_path('uploads/products/gallery'), $imageName);

                    ProductImage::create([

                        'product_id' => $product->id,

                        'image' => $imageName,

                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('products.index')
                ->with('success', 'Product created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         $categories = Category::where('status',1)->orderBy('name')->get();

    $brands = Brand::where('status',1)->orderBy('name')->get();

    return view('vendor.products.create', compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         $request->validate([
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'name' => 'required|max:255',
        'sku' => 'required|unique:products,sku,' . $product->id,
        'price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'stock' => 'required|integer',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'description' => 'nullable',
        'featured' => 'required|boolean',
        'status' => 'required|boolean',
    ]);

    DB::beginTransaction();

    try {

        $thumbnail = $product->thumbnail;

        // Update Thumbnail
        if ($request->hasFile('thumbnail')) {

            if ($product->thumbnail &&
                File::exists(public_path('uploads/products/thumbnails/' . $product->thumbnail))) {

                File::delete(public_path('uploads/products/thumbnails/' . $product->thumbnail));
            }

            $file = $request->file('thumbnail');

            $thumbnail = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads/products/thumbnails'), $thumbnail);
        }

        // Update Product
        $product->update([

            'vendor_id' => Auth::id(),

            'category_id' => $request->category_id,

            'brand_id' => $request->brand_id,

            'name' => $request->name,

            'slug' => Str::slug($request->name),

            'sku' => $request->sku,

            'price' => $request->price,

            'sale_price' => $request->sale_price,

            'stock' => $request->stock,

            'description' => $request->description,

            'thumbnail' => $thumbnail,

            'featured' => $request->featured,

            'status' => $request->status,

        ]);

        // Add New Gallery Images
        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $image) {

                $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                $image->move(public_path('uploads/products/gallery'), $imageName);

                ProductImage::create([

                    'product_id' => $product->id,

                    'image' => $imageName,

                ]);
            }
        }

        DB::commit();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
