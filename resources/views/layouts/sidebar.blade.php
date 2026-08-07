<div class="sidebar">

    @if(Auth::user()->hasRole('vendor'))

        <div class="logo">
            <i class="bi bi-shop"></i> Vendor Panel
        </div>

        <a href="{{ route('vendor.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('categories.index') }}">
            <i class="bi bi-grid"></i> Categories
        </a>

        <a href="{{ route('brands.index') }}">
            <i class="bi bi-tag"></i> Brands
        </a>

        <a href="{{ route('products.index') }}">
            <i class="bi bi-box"></i> Products
        </a>

        <a href="{{ route('vendor.orders') }}">
            <i class="bi bi-cart"></i> Orders
        </a>

        <a href="{{ route('categories.index') }}">
            <i class="bi bi-book-half"></i> Course Categories
        </a>

        <a href="{{ route('course.index') }}">
            <i class="bi bi-book-half"></i> Course
        </a>

      <a href="{{ route('sections.index') }}">
    <i class="bi bi-collection"></i> Course Sections
</a>

        <a href="#">
            <i class="bi bi-ticket"></i> Coupons
        </a>

        <a href="#">
            <i class="bi bi-graph-up"></i> Reports
        </a>

        <a href="#">
            <i class="bi bi-person"></i> Profile
        </a>

    @elseif(Auth::user()->hasRole('super-admin'))

        <div class="logo">
            <i class="bi bi-shield-check"></i> Super Admin
        </div>

        <a href="{{ route('superadmin.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('users.index') }}">
            <i class="bi bi-people"></i> Users
        </a>

        <a href="{{ route('vendors.index') }}">
            <i class="bi bi-shop-window"></i> Vendors
        </a>

        <a href="#">
            <i class="bi bi-check-circle"></i> Vendor Approval
        </a>

    @elseif(Auth::user()->hasRole('admin'))

        <div class="logo">
            <i class="bi bi-person-badge"></i> Admin Panel
        </div>

        <a href="#">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="#">
            <i class="bi bi-people"></i> Manage Users
        </a>

        <a href="#">
            <i class="bi bi-box"></i> Products
        </a>

        <a href="#">
            <i class="bi bi-cart"></i> Orders
        </a>

    @endif

    <!-- Common Logout -->
    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="logout-link">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>

</div>
