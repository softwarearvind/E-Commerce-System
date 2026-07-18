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
                    <i class="bi bi-award"></i> Brands
                </h4>

                <small class="text-muted">
                    Manage all brands
                </small>
            </div>

            <a href="{{ route('brands.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Brand
            </a>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                    <tr>

                        <th width="60">#</th>

                        <th width="100">Logo</th>

                        <th>Name</th>

                        <th>Slug</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($brands as $brand)

                    <tr>

                        <td>{{ $brands->firstItem() + $loop->index }}</td>

                        <td>

                            @if($brand->logo)

                                <img src="{{ asset('uploads/brands/'.$brand->logo) }}"
                                     width="60"
                                     height="60"
                                     class="rounded">

                            @else

                                <img src="https://placehold.co/60x60?text=Logo"
                                     width="60"
                                     height="60"
                                     class="rounded">

                            @endif

                        </td>

                        <td>{{ $brand->name }}</td>

                        <td>{{ $brand->slug }}</td>

                        <td>

                            @if($brand->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('brands.edit',$brand->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('brands.destroy',$brand->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this brand?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            No Brand Found

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $brands->links() }}
            </div>

        </div>

    </div>

</div>

</div>

</body>
</html>
