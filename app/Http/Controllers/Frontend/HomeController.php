<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)
            ->latest()
            ->get();

        $featuredProducts = Product::with(['category', 'brand'])
            ->where('status', 1)
            ->where('featured', 1)
            ->latest()
            ->take(8)
            ->get();

        // Temporary AI Recommended Products
        $recommendedProducts = Product::with(['category', 'brand'])
            ->where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        $brands = Brand::where('status', 1)
            ->latest()
            ->get();

        return view('frontend.home', compact(
            'categories',
            'featuredProducts',
            'recommendedProducts',
            'brands'
        ));
    }

   public function viewProduct($slug)
{
    $product = Product::with([
        'category',
        'brand',
        'productImages'
    ])->where('slug', $slug)->firstOrFail();

    return view('frontend.view_product', compact('product'));
}




}
