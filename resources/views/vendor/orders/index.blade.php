<!DOCTYPE html>
<html lang="en">
@include('layouts.link')
<body>
@include('layouts.sidebar')
</div>
@include('layouts.top')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-cart-check text-primary"></i> My Orders
        </h3>

        <span class="badge bg-primary fs-6">
            Total Orders : {{ $orders->total() }}
        </span>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td>
                                <strong>#{{ date('Y') }}{{ str_pad($order->id,5,'0',STR_PAD_LEFT) }}</strong>
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $order->user->name ?? '-' }}
                                </div>

                                <small class="text-muted">
                                    {{ $order->user->email ?? '' }}
                                </small>
                            </td>

                            <td>
                                <strong class="text-success">
                                    ₹{{ number_format($order->total_amount,2) }}
                                </strong>
                            </td>

                            <td>
                                @if($order->payment_status=='paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>

                            <td>

                                @switch($order->status)

                                    @case('pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @break

                                    @case('processing')
                                    <span class="badge bg-info">Processing</span>
                                    @break

                                    @case('shipped')
                                    <span class="badge bg-primary">Shipped</span>
                                    @break

                                    @case('delivered')
                                    <span class="badge bg-success">Delivered</span>
                                    @break

                                    @default
                                    <span class="badge bg-danger">Cancelled</span>

                                @endswitch

                            </td>

                            <td>
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td>

                                <a href="{{ route('orders.show',$order->id) }}"
                                   class="btn btn-sm btn-outline-primary">

                                    <i class="bi bi-eye"></i> View

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076504.png"
                                     width="120">

                                <h5 class="mt-3">No Orders Found</h5>

                                <p class="text-muted">
                                    Orders from your products will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>

        </div>
    </div>

</div>




</div>

</body>
</html>
