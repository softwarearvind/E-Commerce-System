<?php

namespace App\Http\Controllers\Vindor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class VindorController extends Controller
{
    public function index()
    {
        $vendorId = auth()->id();
        $totalProducts = Product::where('vendor_id', $vendorId)->count();
        // Count total orders for the vendor
         $totalOrders = Order::whereHas('items.product', function ($query) use ($vendorId) {
        $query->where('vendor_id', $vendorId);
    })->count();

    // Revenue (sirf vendor ke products ka)
    $revenue = DB::table('order_items')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->where('products.vendor_id', $vendorId)
        ->sum(DB::raw('order_items.price * order_items.quantity'));

          // Pending Orders
    $pendingOrders = Order::where('status', 'pending')
        ->whereHas('items.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->count();

        //chart data for monthly revenue
        $monthlyRevenue = DB::table('order_items')
    ->join('products', 'products.id', '=', 'order_items.product_id')
    ->join('orders', 'orders.id', '=', 'order_items.order_id')
    ->where('products.vendor_id', auth()->id())
    ->whereYear('orders.created_at', date('Y'))
    ->select(
        DB::raw('MONTH(orders.created_at) as month'),
        DB::raw('SUM(order_items.price * order_items.quantity) as revenue')
    )
    ->groupBy('month')
    ->pluck('revenue', 'month');

$months = [];
$revenues = [];

for ($i = 1; $i <= 12; $i++) {
    $months[] = date('M', mktime(0, 0, 0, $i, 1));
    $revenues[] = $monthlyRevenue[$i] ?? 0;
}
// Recent 5 Orders
$recentOrders = Order::whereHas('items.product', function ($query) {
        $query->where('vendor_id', auth()->id());
    })
    ->with('user')
    ->latest()
    ->take(5)
    ->get();

    // Low Stock Products (Stock <= 5)
$lowStocks = Product::where('vendor_id', auth()->id())
    ->where('stock', '<=', 5)
    ->orderBy('stock')
    ->take(5)
    ->get();

return view('vendor.dashboard',compact('totalProducts', 'totalOrders', 'revenue', 'pendingOrders', 'months', 'revenues', 'recentOrders', 'lowStocks'));
    }

    public function orders()
    {
         $orders = Order::whereHas('items.product', function ($query) {
                $query->where('vendor_id', auth()->id());
            })
            ->with(['items.product', 'user'])
            ->latest()
            ->paginate(10);
          return view('vendor.orders.index', compact('orders'));
   
    }

    public function show($id)
{
    $order = Order::with(['items.product', 'user'])->findOrFail($id);
    return view('vendor.orders.show', compact('order'));
}
}
