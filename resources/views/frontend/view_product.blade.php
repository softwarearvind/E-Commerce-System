<!DOCTYPE html>
<html lang="en">
@include('layouts.websitelink')

<body>

@include('layouts.websitenavbar')

<div class="container py-5">
    <div class="row g-5">

        <!-- Product Images -->
        <div class="col-lg-6">

            @if($product->productImages->count())

                <!-- Main Image -->
                <div class="border rounded p-3 text-center mb-3 bg-white">
                    <img id="mainImage"
                        src="{{ asset('uploads/products/gallery/'.$product->productImages->first()->image) }}"
                        class="img-fluid"
                        style="max-height:450px; object-fit:contain;">
                </div>

                <!-- Thumbnails -->
                <div class="d-flex gap-2 flex-wrap">
                    @foreach($product->productImages as $image)
                        <img
                            src="{{ asset('uploads/products/gallery/'.$image->image) }}"
                            class="border rounded p-1"
                            width="80"
                            height="80"
                            style="cursor:pointer; object-fit:cover;"
                            onclick="changeImage(this)">
                    @endforeach
                </div>

            @endif

        </div>

        <!-- Product Details -->
        <d class="col-lg-6">

    <h2>{{ ucwords($product->name) }}</h2>

    <h3 class="text-danger">
        ₹{{ number_format($product->price, 2) }}
    </h3>

    <p>
        <strong>Brand:</strong> {{ $product->brand?->name }}
    </p>

    <p>
        <strong>Category:</strong> {{ $product->category?->name }}
    </p>

    <p>
        <strong>Available Stock:</strong>

        @if($product->stock > 0)
            <span class="badge bg-success">{{ $product->stock }} In Stock</span>
        @else
            <span class="badge bg-danger">Out of Stock</span>
        @endif
    </p>


            <h2 class="fw-bold mb-3">
               {{ ucfirst($product->name) }}
            </h2>

            <h3 class="text-danger mb-3">
                ₹{{ number_format($product->price,2) }}
            </h3>

            <p>
                <strong>Brand:</strong>
                {{ $product->brand?->name }}
            </p>

            <p>
                <strong>Category:</strong>
                {{ $product->category?->name }}
            </p>

            <hr>

            <p>
                {{ $product->description }}
            </p>
<div class="d-flex gap-3 mt-4">

  <form action="{{ route('cart.add') }}" method="POST">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <button type="submit" class="btn btn-warning btn-lg px-5 rounded-pill">
        <i class="bi bi-cart-plus"></i> Add to Cart
    </button>
</form>

    <button class="btn btn-danger btn-lg px-5 rounded-pill">
        <i class="bi bi-lightning-charge-fill"></i> Buy Now
    </button>

</div>

        </div>

    </div>
</div>

@include('layouts.websitefooter')

<script>
function changeImage(img){
    document.getElementById('mainImage').src = img.src;
}
</script>

</body>
</html>
