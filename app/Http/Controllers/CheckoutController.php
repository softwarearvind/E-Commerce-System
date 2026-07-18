<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
     public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(function($cart){
            return $cart->price * $cart->quantity;
        });

        return view('frontend.checkout', compact('carts','total'));
    }

     public function placeOrder(Request $request)
    {
        // Validation
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string',
            'city'     => 'required|string|max:100',
            'pincode'  => 'required|string|max:10',
        ]);

        DB::beginTransaction();

        try {

            // User Cart
            $carts = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();

            if ($carts->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            // Total Amount
            $total = $carts->sum(function ($cart) {
                return $cart->price * $cart->quantity;
            });

            // Create Order
            $order = Order::create([
                'user_id'        => Auth::id(),
                'name'           => $request->name,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'city'           => $request->city,
                'pincode'        => $request->pincode,
                'total_amount'   => $total,
                'status'         => 'pending',
                'payment_status' => 'pending',
            ]);

            // Save Order Items
            foreach ($carts as $cart) {

                // Stock Check
                if ($cart->product->stock < $cart->quantity) {
                    throw new \Exception($cart->product->name . ' is out of stock.');
                }

                OrderItem::create([
                    'order_id'  => $order->id,
                    'product_id'=> $cart->product_id,
                    'quantity'  => $cart->quantity,
                    'price'     => $cart->price,
                    'subtotal'  => $cart->price * $cart->quantity,
                ]);

                // Reduce Stock
                $cart->product->decrement('stock', $cart->quantity);
            }

            // Clear Cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('payment.index', $order->id);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}


