<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

    $cart = Cart::where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->first();

    if ($cart) {
        $cart->increment('quantity');
    } else {
        Cart::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
            'quantity'   => 1,
            'price'      => $product->price,
        ]);
    }

    return back()->with('success', 'Product added to cart successfully.');
    }


    public function viewcart()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
         return view('frontend.cart', compact('carts'));
    }


    public function update(Request $request, $id)
{
    $cart = Cart::findOrFail($id);

    if($request->action == 'increase') {

        $cart->increment('quantity');

    } else {

        if($cart->quantity > 1){
            $cart->decrement('quantity');
        }

    }

    return back();
}

    public function remove($id)
{
    $cart = Cart::findOrFail($id);

    $cart->delete();

    return back()->with('success', 'Product removed from cart.');
}
}
