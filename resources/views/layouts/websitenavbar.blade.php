<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-3 text-primary" href="{{ route('home') }}">
            AI<span class="text-dark">Shop</span>
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <!-- Menu -->
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Shop</a>
                </li>

              <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
        Categories
    </a>


</li>


              <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
        Brands
    </a>


</li>


                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

            </ul>

            <!-- Search -->
            <form class="d-flex me-3">

                <input class="form-control"
                       type="search"
                       placeholder="Search Products">

            </form>

            <!-- Icons -->
            <div class="d-flex align-items-center">

<a href="{{ route('cart.index') }}" class="btn btn-light position-relative me-2">

    <i class="bi bi-cart3 fs-5"></i>

    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{ $cartCount ?? 0 }}
    </span>

</a>

               @auth
    @if(auth()->user()->hasRole('customer'))
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
            </button>

            <ul class="dropdown-menu">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @endIf
@endauth

@guest
    <a href="{{ route('login') }}" class="btn btn-primary me-2">
        Login
    </a>

    <a href="{{ route('register') }}" class="btn btn-success">
        Register
    </a>
@endguest

            </div>

        </div>

    </div>

</nav>
