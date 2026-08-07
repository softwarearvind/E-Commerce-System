<!DOCTYPE html>
<html lang="en">

@include('layouts.link')

<body>

@include('layouts.sidebar')

<div class="main-content">

@include('layouts.top')


<div class="container-fluid mt-4">


    <!-- Header -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">


            <div>

                <h4 class="mb-1">
                    <i class="bi bi-collection-play text-primary"></i>
                    Course Sections
                </h4>

                <p class="text-muted mb-0">
                    {{ $course->title }}
                </p>

            </div>


            <a href="{{ route('courses.course-sections.create',$course->id) }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>
                Add Section

            </a>


        </div>

    </div>





    <!-- Search -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">


            <form method="GET">

                <div class="row">


                    <div class="col-md-5">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search section...">

                    </div>


                    <div class="col-md-2">

                        <button class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>
                            Search

                        </button>

                    </div>


                </div>

            </form>


        </div>

    </div>





    <!-- Table -->

    <div class="card shadow-sm border-0">


        <div class="card-body p-0">


            <div class="table-responsive">


                <table class="table table-hover align-middle mb-0">


                    <thead class="table-light">


                        <tr>

                            <th>#</th>

                            <th>Section Name</th>

                            <th>Description</th>

                            <th>Order</th>

                            <th>Status</th>

                            <th width="200">
                                Action
                            </th>

                        </tr>


                    </thead>



                    <tbody>


                    @forelse($sections as $section)


                    <tr>


                        <td>
                            {{ $loop->iteration }}
                        </td>



                        <td>

                            <strong>
                                <i class="bi bi-folder-fill text-warning"></i>

                                {{ $section->title }}

                            </strong>

                        </td>



                        <td>

                            {{ Str::limit($section->description,50) }}

                        </td>



                        <td>

                            <span class="badge bg-secondary">

                                {{ $section->sort_order }}

                            </span>

                        </td>




                        <td>


                            @if($section->status)

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


                            <a href="#"
                               class="btn btn-info btn-sm">

                                <i class="bi bi-play-circle"></i>
                                Lessons

                            </a>



                            <a href="#"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>




                            <form action="{{ route('courses.course-sections.destroy',$section->id) }}"
                                  method="POST"
                                  class="d-inline">


                                @csrf
                                @method('DELETE')


                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Section?')">

                                    <i class="bi bi-trash"></i>

                                </button>


                            </form>


                        </td>



                    </tr>



                    @empty


                    <tr>

                        <td colspan="6"
                            class="text-center py-4 text-muted">


                            <i class="bi bi-folder-x fs-3"></i>

                            <br>

                            No Sections Found


                        </td>


                    </tr>


                    @endforelse



                    </tbody>


                </table>


            </div>


        </div>


    </div>



</div>


</div>


</body>

</html>
