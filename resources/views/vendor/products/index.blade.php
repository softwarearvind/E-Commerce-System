<!DOCTYPE html>
<html lang="en">
@include('layouts.link')
<body>
@include('layouts.sidebar')
</div>
@include('layouts.top')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>
                <h4 class="mb-0">
                    <i class="bi bi-box-seam"></i> Products
                </h4>

                <small class="text-muted">
                    Manage all products
                </small>
            </div>

            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>

        </div>

        <div class="card-body">

            <!-- Search -->

            <form method="GET" action="{{ route('products.index') }}" class="row mb-3">

                <div class="col-md-4">

                    <input type="text"
                           name="search"
                           class="form-control"
                           value="{{ request('search') }}"
                           placeholder="Search Product...">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-dark">
                        <i class="bi bi-search"></i> Search
                    </button>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                    <tr>

                        <th>#</th>

                        <th>Image</th>

                        <th>Product</th>

                        <th>Category</th>

                        <th>Brand</th>

                        <th>SKU</th>

                        <th>Price</th>

                        <th>Stock</th>

                        <th>Status</th>

                        <th width="170">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($products as $product)

                    <tr>

                        <td>{{ $products->firstItem() + $loop->index }}</td>

                        <td>

                            @if($product->thumbnail)

                                <img src="{{ asset('uploads/products/thumbnails/'.$product->thumbnail) }}"
                                     width="60"
                                     height="60"
                                     class="rounded">

                            @else

                                <img src="https://placehold.co/60x60?text=No+Image"
                                     class="rounded">

                            @endif

                        </td>

                        <td>

                            <strong>{{ $product->name }}</strong>

                            <br>

                            <small class="text-muted">
                                {{ $product->slug }}
                            </small>

                        </td>

                        <td>

                            {{ $product->category->name ?? '-' }}

                        </td>

                        <td>

                            {{ $product->brand->name ?? '-' }}

                        </td>

                        <td>

                            {{ $product->sku }}

                        </td>

                        <td>

                            ₹{{ number_format($product->price,2) }}

                        </td>

                        <td>

                            @if($product->stock <= 5)

                                <span class="badge bg-danger">

                                    {{ $product->stock }}

                                </span>

                            @else

                                <span class="badge bg-success">

                                    {{ $product->stock }}

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($product->status)

                                <span class="badge bg-success">

                                    Active

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    Inactive

                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('products.edit',$product->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('products.destroy',$product->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this product?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="10" class="text-center">

                            No Products Found

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $products->links() }}

            </div>

        </div>

    </div>

</div>

</div>

</body>
</html>
