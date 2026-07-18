<section class="container mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Shop by Category</h3>

        <a href="#">View All</a>

    </div>

    <div class="row">

        @foreach($categories as $category)

        <div class="col-lg-2 col-md-3 col-6 mb-4">

            <div class="card border-0 shadow-sm text-center">

                <img src="{{ asset('uploads/categories/'.$category->image) }}"
                     class="card-img-top"
                     style="height:120px;object-fit:cover;">

                <div class="card-body">

                    <strong>{{ $category->name }}</strong>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>
