<!DOCTYPE html>
<html lang="en">

@include('layouts.link')

<body>

@include('layouts.sidebar')

<div class="main-content">

@include('layouts.top')

@include('layouts.massage')

<div class="container-fluid mt-4">


    <div class="card shadow-sm border-0">

        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>
                <h4 class="mb-0">
                    <i class="bi bi-book-half text-primary"></i>
                    Course Categories
                </h4>

                <small class="text-muted">
                    Manage your course categories
                </small>
            </div>


            <a href="{{ route('categories.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>
                Add Category

            </a>

        </div>


        <!-- Table -->
        <div class="card-body">


            <div class="table-responsive">

                <table class="table table-hover align-middle">


                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Image</th>

                            <th>Category Name</th>

                            <th>Description</th>

                            <th>Status</th>

                            <th width="180">Action</th>

                        </tr>

                    </thead>


                    <tbody>


                    @forelse($categories as $category)


                    <tr>


                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>

                            @if($category->image)

                            <img src="{{ asset('storage/'.$category->image) }}"
                                 width="55"
                                 height="55"
                                 class="rounded-circle object-fit-cover">

                            @else

                            <img src="https://via.placeholder.com/55"
                                 class="rounded-circle">

                            @endif

                        </td>



                        <td>

                            <strong>
                                {{ $category->name }}
                            </strong>

                        </td>



                        <td>

                            {{ Str::limit($category->description,50) }}

                        </td>



                        <td>


                            @if($category->status)

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


                            <a href="{{ route('categories.edit',$category->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>



                            <form action="{{ route('categories.destroy',$category->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')


                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Category?')">

                                    <i class="bi bi-trash"></i>

                                </button>


                            </form>


                        </td>


                    </tr>


                    @empty


                    <tr>

                        <td colspan="6"
                            class="text-center py-4 text-muted">

                            No Course Categories Found

                        </td>

                    </tr>


                    @endforelse


                    </tbody>


                </table>


            </div>


            {{ $categories->links() }}


        </div>


    </div>



</div>


</div>

</body>

</html>
