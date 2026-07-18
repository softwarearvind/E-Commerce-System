<section class="container mb-5">

    <div class="d-flex justify-content-between mb-4">

        <h3>Featured Products</h3>

        <a href="#">View All</a>

    </div>

    <div class="row">

        @foreach($featuredProducts as $product)

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

            <div class="card h-100 shadow-sm">

                <img src="{{ asset('uploads/products/thumbnails/'.$product->thumbnail) }}"
                     class="card-img-top"
                     style="height:220px;object-fit:cover;">

                <div class="card-body">

                    <h6>{{ $product->name }}</h6>

                   <p class="text-muted mb-1">
    <a href="{{ route('view.products', $product->slug) }}" class="text-decoration-none">
        {{ $product->brand->name ?? '' }}
    </a>
</p>

                    <h5 class="text-primary">
                        ₹{{ number_format($product->price,2) }}
                    </h5>

                    <a href="{{ route('view.products', $product->slug) }}" class="btn btn-dark w-100">

                        Add to Cart

                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>

<!-- AI Recommended -->

<section class="container mb-5">

    <div class="alert alert-primary">

        🤖 <strong>AI Recommended Products For You</strong>

    </div>

    <div class="row">

        @foreach($recommendedProducts as $product)

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

            <div class="card border-primary">

                <img src="{{ asset('uploads/products/thumbnails/'.$product->thumbnail) }}"
                     class="card-img-top"
                     style="height:220px;object-fit:cover;">

                <div class="card-body">

                    <h6>{{ $product->name }}</h6>
                     <p class="text-muted mb-1">
    <a href="{{ route('view.products', $product->slug) }}" class="text-decoration-none">
        {{ $product->brand->name ?? '' }}
    </a>
</p>

                    <p class="text-success">
                        Recommended by AI
                    </p>

                    <h5>
                        ₹{{ number_format($product->price,2) }}
                    </h5>

                    <a href="{{ route('view.products', $product->slug) }}" class="btn btn-primary w-100">

                        Buy Now

                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>

<!-- Top Brands -->

<section class="container mb-5">

    <h3 class="mb-4">Top Brands</h3>

    <div class="row">

        @foreach($brands as $brand)

        <div class="col-lg-2 col-md-3 col-6 mb-3">

            <div class="card shadow-sm text-center">

                <div class="card-body">

                    <img src="{{ asset('uploads/brands/'.$brand->logo) }}"
                         width="80">

                    <h6 class="mt-3">

                        {{ $brand->name }}

                    </h6>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>
