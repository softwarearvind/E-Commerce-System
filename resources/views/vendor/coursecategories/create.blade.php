<!DOCTYPE html>
<html lang="en">

@include('layouts.link')

<body>

@include('layouts.sidebar')

<div class="main-content">

@include('layouts.top')




<div class="container-fluid mt-4">


    <div class="card shadow-sm border-0">


        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                <i class="bi bi-folder-plus"></i>
                Add Course Category
            </h4>


            <a href="{{ route('categories.index') }}"
               class="btn btn-light btn-sm">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>


        </div>



        <div class="card-body">


            <form action="{{ route('categories.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                <div class="row">


                    <!-- Category Name -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Category Name
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter category name"
                               value="{{ old('name') }}">


                        @error('name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>



                    <!-- Image -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Category Image
                        </label>


                        <input type="file"
                               name="image"
                               class="form-control">


                        @error('image')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror


                    </div>




                    <!-- Description -->
                    <div class="col-12 mb-3">


                        <label class="form-label">
                            Description
                        </label>


                        <textarea name="description"
                                  class="form-control"
                                  rows="5"
                                  placeholder="Enter category description">{{ old('description') }}</textarea>


                    </div>





                    <!-- Status -->
                    <div class="col-md-4 mb-3">


                        <label class="form-label">
                            Status
                        </label>


                        <select name="status"
                                class="form-select">


                            <option value="1">
                                Active
                            </option>


                            <option value="0">
                                Inactive
                            </option>


                        </select>


                    </div>



                </div>




                <button type="submit"
                        class="btn btn-success">

                    <i class="bi bi-check-circle"></i>
                    Save Category

                </button>



                <a href="{{ route('categories.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>



            </form>



        </div>


    </div>



</div>


</div>


</body>

</html>
