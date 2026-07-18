<section class="container-fluid p-0 mb-5">

    <div id="heroSlider" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">

            <div class="carousel-item active">

                <img src="{{ asset('frontend/images/1.webp') }}"
                     class="d-block w-100"
                     style="height:300px;object-fit:cover;">

            </div>

            <div class="carousel-item">

                <img src="{{ asset('frontend/images/2.webp') }}"
                     class="d-block w-100"
                     style="height:300px;object-fit:cover;">

            </div>

        </div>

        <!-- Previous Button -->
        <button class="carousel-control-prev"
                type="button"
                data-bs-target="#heroSlider"
                data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <!-- Next Button -->
        <button class="carousel-control-next"
                type="button"
                data-bs-target="#heroSlider"
                data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

</section>
