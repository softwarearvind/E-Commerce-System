<!DOCTYPE html>
<html lang="en">

@include('layouts.websitelink')

<body>

@include('layouts.websitenavbar')


<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Checkout
    </h2>


    <form action="{{ route('order.place') }}" method="POST">
        @csrf

        <div class="row g-4">


            <!-- Billing Details -->
            <div class="col-lg-7">

                <div class="card shadow border-0">

                    <div class="card-body">

                        <h4 class="fw-bold mb-3">
                            Delivery Address
                        </h4>


                        <input type="text"
                        name="name"
                        class="form-control mb-3"
                        value="{{ auth()->user()->name }}"
                        placeholder="Name">


                        <input type="text"
                        name="phone"
                        class="form-control mb-3"
                        value="{{ auth()->user()->phone }}"
                        placeholder="Phone">


                        <textarea name="address"
                        class="form-control mb-3"
                        placeholder="Address">{{ auth()->user()->address }}</textarea>


                        <input type="text"
                        name="city"
                        class="form-control mb-3"
                        placeholder="City">


                        <input type="text"
                        name="pincode"
                        class="form-control mb-3"
                        placeholder="Pincode">


                    </div>

                </div>


            </div>



            <!-- Order Summary -->
            <div class="col-lg-5">


                <div class="card shadow border-0">


                    <div class="card-body">


                        <h4 class="fw-bold mb-3">
                            Your Order
                        </h4>



                        @foreach($carts as $cart)


                        <div class="d-flex align-items-center mb-3">


                            <img src="{{ asset('uploads/products/gallery/'.$cart->product->productImages->first()->image) }}"
                            width="70"
                            height="70"
                            class="rounded border">


                            <div class="ms-3">

                                <h6 class="mb-1">
                                    {{ ucwords($cart->product->name) }}
                                </h6>


                                <small>
                                    Qty: {{ $cart->quantity }}
                                </small>


                            </div>



                            <div class="ms-auto">

                                ₹{{ number_format($cart->price*$cart->quantity,2) }}

                            </div>



                        </div>


                        @endforeach



                        <hr>


                        <h5 class="fw-bold">

                            Total :
                            ₹{{ number_format($total,2) }}

                        </h5>



                        <button type="submit"
                        class="btn btn-success w-100 btn-lg mt-3 rounded-pill">


                            <i class="bi bi-check-circle"></i>

                            Place Order


                        </button>



                    </div>


                </div>



            </div>


        </div>


    </form>



</div>


@include('layouts.websitefooter')


</body>

</html>
