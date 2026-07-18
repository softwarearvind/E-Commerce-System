<!DOCTYPE html>
<html lang="en">
@include('layouts.link')
<body>
@include('layouts.sidebar')
</div>
@include('layouts.top')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>
                <h4 class="mb-0">
                    <i class="bi bi-grid"></i> Categories
                </h4>
                <small class="text-muted">
                    Manage all product categories
                </small>
            </div>

            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Category
            </a>

        </div>

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-4">

                    <form>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search Category">

                        </div>

                    </form>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                    <tr>

                        <th width="60">Sn</th>
                        <th width="100">Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th width="180">Action</th>

                    </tr>

                    </thead>

                   <tbody>

@forelse($categories as $category)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>
        @if($category->image)
            <img src="{{ asset('uploads/categories/'.$category->image) }}"
                 class="rounded"
                 width="60"
                 height="60">
        @else
            <img src="https://via.placeholder.com/60"
                 class="rounded"
                 width="60"
                 height="60">
        @endif
    </td>

    <td>{{ $category->name }}</td>

    <td>{{ $category->slug }}</td>

    <td>
        @if($category->status)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </td>

    <td>

        <a href="{{ route('categories.edit', $category->id) }}"
           class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i>
        </a>

        <form action="{{ route('categories.destroy', $category->id) }}"
              method="POST"
              class="d-inline">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i>
            </button>

        </form>

    </td>

</tr>

@empty

<tr>
    <td colspan="6" class="text-center text-muted">
        No Categories Found
    </td>
</tr>

@endforelse

</tbody>

                </table>
                <div class="mt-3">
    {{ $categories->links() }}
</div>

            </div>

        </div>

    </div>

</div>

</div>

</body>
</html>
