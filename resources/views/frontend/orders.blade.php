<!DOCTYPE html>
<html lang="en">
@include('layouts.websitelink')
<body>

<!-- ================= HEADER ================= -->

@include('layouts.websitenavbar')

<!-- ================= HERO ================= -->
<div class="container py-5">

    <h2 class="fw-bold mb-4">My Orders</h2>

    @forelse($orders as $order)

        <div class="card shadow-sm border-0 mb-4">

            <!-- Order Header -->
            <div class="card-header bg-light">
                <div class="row text-center text-md-start">

                    <div class="col-md-3">
                        <small class="text-muted">ORDER PLACED</small><br>
                        <strong>{{ $order->created_at->format('d M Y') }}</strong>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">TOTAL</small><br>
                        <strong>₹{{ $order->total_amount }}</strong>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">STATUS</small><br>

                        @if($order->status=='pending')
                            <span class="badge bg-warning">Pending</span>

                        @elseif($order->status=='processing')
                            <span class="badge bg-info">Processing</span>

                        @elseif($order->status=='shipped')
                            <span class="badge bg-primary">Shipped</span>

                        @elseif($order->status=='delivered')
                            <span class="badge bg-success">Delivered</span>

                        @else
                            <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                        @endif
                    </div>

                    <div class="col-md-3 text-md-end">
                        <small class="text-muted">ORDER #</small><br>
                       <strong>ORD-{{ date('Ymd') }}-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>
                    </div>

                </div>
            </div>

            <!-- Products -->
            <div class="card-body">

                @foreach($order->items as $item)

                    <div class="row align-items-center py-3 border-bottom">

                        <div class="col-md-2 text-center">
                            <img src="{{ asset('uploads/products/thumbnails/'.$item->product->thumbnail) }}"
                                 class="img-fluid rounded"
                                 style="height:90px;">
                        </div>

                        <div class="col-md-5">
                            <h5 class="mb-1">{{ $item->product->name }}</h5>

                            <p class="text-muted mb-1">
                                Quantity : {{ $item->quantity }}
                            </p>

                            <h5 class="text-success">
                                ₹{{ number_format($item->price,2) }}
                            </h5>
                        </div>

                        <div class="col-md-3">

                            @if($order->status=='delivered')
                                <span class="text-success fw-bold">
                                    ✔ Delivered
                                </span>

                            @elseif($order->status=='shipped')
                                <span class="text-primary fw-bold">
                                    🚚 Shipped
                                </span>

                            @elseif($order->status=='processing')
                                <span class="text-info fw-bold">
                                    📦 Processing
                                </span>

                            @else
                                <span class="text-warning fw-bold">
                                    ⏳ Pending
                                </span>
                            @endif

                        </div>

                        <div class="col-md-2 text-end">

                            <a href=""
                               class="btn btn-warning btn-sm w-100 mb-2">
                                Track Order
                            </a>

                            <a href=""
                               class="btn btn-outline-dark btn-sm w-100">
                                View Details
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @empty

        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                 width="120">

            <h4 class="mt-3">No Orders Found</h4>

            <a href="{{ url('/') }}" class="btn btn-warning mt-3">
                Continue Shopping
            </a>
        </div>

    @endforelse

</div>

<!-- Newsletter -->
@include('layouts.websitefooter')

</body>
</html>
