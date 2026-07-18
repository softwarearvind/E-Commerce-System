<!DOCTYPE html>
<html lang="en">
@include('layouts.websitelink')
<body>

<!-- ================= HEADER ================= -->

@include('layouts.websitenavbar')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="border-0 shadow-lg card rounded-4">

                <div class="py-3 text-white card-header bg-primary">
                    <h3 class="mb-0">
                       Payment
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-8">

                            <h4 class="fw-bold">
                               Order No: ORD-{{ date('Y') }}-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </h4>

                            <p class="text-muted">
                                Complete your payment securely using Razorpay.
                            </p>

                            <table class="table">

                                <tr>
                                    <th>Order ID</th>
                                    <td># Order No: ORD-{{ date('Y') }}-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                </tr>

                                <tr>
                                    <th>Total Amount</th>
                                    <td class="text-success fw-bold">
                                        ₹{{ number_format($order->total_amount,2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Payment Status</th>
                                    <td>
                                        <span class="badge bg-warning">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                </tr>

                            </table>

                        </div>

                        <div class="text-center col-md-4">

                            <img src="https://razorpay.com/assets/razorpay-logo.svg"
                                 class="mb-3 img-fluid"
                                 style="max-height:80px;">

                           <button id="rzp-button" class="btn btn-success btn-lg w-100">
    Pay ₹{{ number_format($order->total_amount,2) }}
</button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- Newsletter -->
@include('layouts.websitefooter')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

</body>
</html>
