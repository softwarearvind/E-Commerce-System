<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function index(Order $order)
{
    $api = new Api(
        config('services.razorpay.key'),
        config('services.razorpay.secret')
    );

    $razorpayOrder = $api->order->create([
        'receipt' => 'order_'.$order->id,
        'amount' => $order->total_amount * 100, // Razorpay amount in paise
        'currency' => 'INR'
    ]);

    $order->update([
        'razorpay_order_id' => $razorpayOrder['id']
    ]);

    return view('frontend.payment', compact('order', 'razorpayOrder'));
}
}
