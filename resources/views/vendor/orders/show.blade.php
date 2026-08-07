<!DOCTYPE html>
<html lang="en">
@include('layouts.link')
<body>
@include('layouts.sidebar')
</div>
@include('layouts.top')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-receipt"></i>
            Order #{{ date('Y') }}-{{ str_pad($order->id,5,'0',STR_PAD_LEFT) }}
        </h3>

        <a href="{{ route('vendor.orders') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="row">

        <!-- Customer Details -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    Customer Details
                </div>

                <div class="card-body">

                    <p><strong>Name :</strong> {{ $order->user->name ?? '-' }}</p>

                    <p><strong>Email :</strong> {{ $order->user->email ?? '-' }}</p>

                    <p><strong>Phone :</strong> {{ $order->phone }}</p>

                    <p><strong>Address :</strong><br>
                        {{ $order->address }}
                    </p>

                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="col-md-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-dark text-white">
                    Ordered Products
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle">

                            <thead class="table-light">

                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>

                            </thead>

                            <tbody>

                            @foreach($order->items as $item)

                            <tr>

                                <td width="90">

                                    <img src="{{ asset('uploads/products/thumbnails/'.$item->product->thumbnail) }}"
                                         width="70"
                                         class="rounded">

                                </td>

                                <td>

                                    <strong>{{ $item->product->name }}</strong>

                                </td>

                                <td>{{ $item->quantity }}</td>

                                <td>₹{{ number_format($item->price,2) }}</td>

                                <td>

                                    ₹{{ number_format($item->price * $item->quantity,2) }}

                                </td>

                            </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-0 mt-4">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <h6>Status</h6>

                            <span class="badge bg-success">
                                {{ ucfirst($order->status) }}
                            </span>

                        </div>

                        <div class="col-md-6 text-end">

                            <h4 class="text-success">
                                Grand Total :
                                ₹{{ number_format($order->total_amount,2) }}
                            </h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



</div>

</body>
</html>
