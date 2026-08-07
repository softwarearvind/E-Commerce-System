<section class="container mb-5">

    <h3 class="mb-4">Top Brands</h3>

    <div class="row">

        @foreach($brands as $brand)

        <div class="col-lg-2 col-md-3 col-6 mb-3">

            <div class="card shadow-sm text-center h-100">

                <div class="card-body">

                    <div class="brand-logo">
                        <img src="{{ asset('uploads/brands/'.$brand->logo) }}"
                             alt="{{ $brand->name }}">
                    </div>

                    <h6 class="mt-3">
                        {{ $brand->name }}
                    </h6>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>


<style>

.brand-logo{
    width:100%;
    height:100px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.brand-logo img{
    width:90px;
    height:90px;
    object-fit:contain;
}

</style>
