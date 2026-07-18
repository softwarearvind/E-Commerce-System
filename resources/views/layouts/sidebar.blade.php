<div class="sidebar">

    <div class="logo">
        Vendor Panel
    </div>

    <a href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('categories.index') }}"><i class="bi bi-grid"></i> Categories</a>
    <a href="{{ route('brands.index') }}"><i class="bi bi-tag"></i> Brands</a>
    <a href="{{ route('products.index') }}"><i class="bi bi-box"></i> Products</a>
    <a href="#"><i class="bi bi-cart"></i> Orders</a>
    <a href="#"><i class="bi bi-ticket"></i> Coupons</a>
    <a href="#"><i class="bi bi-graph-up"></i> Reports</a>
    <a href="#"><i class="bi bi-person"></i> Profile</a>
   <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-link text-start text-decoration-none text-light w-100 py-3 px-4 border-0">
        <i class="bi bi-box-arrow-right"></i> Logout
    </button>
</form>
