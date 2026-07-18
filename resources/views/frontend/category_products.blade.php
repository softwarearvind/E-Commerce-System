<!DOCTYPE html>
<html lang="en">
@include('layouts.websitelink')


<style>
    .product-card{
    transition:.3s;
    border-radius:12px;
}

.product-card:hover{
    transform:translateY(-8px);
}

.product-card .img2{
    opacity:0;
}

.product-card:hover .img2{
    opacity:1;
}

.product-card:hover .img1{
    opacity:0;
}
</style>
<body>

<!-- ================= HEADER ================= -->

@include('layouts.websitenavbar')

<!-- ================= HERO ================= -->

@include('layouts.websitehero')
<!-- Categories -->

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">{{ $category->name }}</h2>
            <small class="text-muted">
             
            </small>
        </div>
    </div>

    <div class="row">

        @forelse($products as $product)

       

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

            <div class="card border-0 shadow product-card h-100">

                <div class="position-relative overflow-hidden">

                    <img src="{{ asset('uploads/products/thumbnails/'.$product->thumbnail) }}"
                        class="card-img-top img1"
                        style="height:250px;object-fit:cover;">

                   

                </div>

                <div class="card-body text-center">

                    <h5>{{ $product->name }}</h5>

                    <h4 class="text-danger">
                        ₹{{ number_format($product->price) }}
                    </h4>

                    <a href=""
                        class="btn btn-dark w-100">
                        View Product
                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-warning text-center">
                No Products Found
            </div>
        </div>

        @endforelse

    </div>

  

</div>

<!-- Newsletter -->
@include('layouts.websitefooter')

</body>
</html>
