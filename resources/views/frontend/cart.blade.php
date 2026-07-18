<!DOCTYPE html>
<html lang="en">
@include('layouts.websitelink')

<body>

@include('layouts.websitenavbar')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container py-5">

    <h2 class="mb-4 fw-bold">
        My Cart
    </h2>

    @if($carts->count() > 0)

    <div class="row">

        <!-- Cart Items -->
        <div class="col-lg-8">

            @foreach($carts as $cart)

            <div class="card shadow-sm mb-3 border-0">

                <div class="card-body">

                    <div class="row align-items-center">

                        <!-- Product Image -->
                        <div class="col-md-3 text-center">

                            <img src="{{ asset('uploads/products/gallery/'.$cart->product->productImages->first()->image) }}"
                                class="img-fluid rounded"
                                style="height:150px; width:150px; object-fit:cover;">

                        </div>


                        <!-- Product Details -->
                        <div class="col-md-6">

                            <h5 class="fw-bold">
                                {{ ucwords($cart->product->name) }}
                            </h5>

                            <p class="text-muted mb-1">
                                Brand:
                                {{ $cart->product->brand?->name }}
                            </p>


                            <h5 class="text-danger">
                                ₹{{ number_format($cart->price,2) }}
                            </h5>


                          <div class="d-flex align-items-center">

    <!-- Minus -->
    <form action="{{ route('cart.update', $cart->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="action" value="decrease">

        <button class="btn btn-outline-secondary btn-sm">
            -
        </button>
    </form>


    <span class="mx-3 fw-bold">
        {{ $cart->quantity }}
    </span>


    <!-- Plus -->
    <form action="{{ route('cart.update', $cart->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="action" value="increase">

        <button class="btn btn-outline-secondary btn-sm">
            +
        </button>
    </form>

</div>

                        </div>


                        <!-- Remove -->
                        <div class="col-md-3 text-end">

                           <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-outline-danger">
        <i class="bi bi-trash"></i>
        Remove
    </button>

</form>

                        </div>


                    </div>

                </div>

            </div>

            @endforeach

        </div>


        <!-- Cart Summary -->
        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h4 class="fw-bold">
                        Cart Summary
                    </h4>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>Total</span>

                        <strong>
                            ₹{{ $carts->sum(fn($item)=>$item->price*$item->quantity) }}
                        </strong>

                    </div>


                   <a href="{{ route('checkout.index') }}"
   class="btn btn-warning w-100 mt-4 btn-lg">
    Proceed To Checkout
</a>


                </div>

            </div>

        </div>


    </div>


    @else

        <div class="alert alert-info">
            Your cart is empty.
        </div>

    @endif


</div>


@include('layouts.websitefooter')

</body>
</html>
