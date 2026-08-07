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
<i class="bi bi-plus-circle"></i>
Add New Course
</h4>



<a href="{{ route('course.index') }}"
class="btn btn-light btn-sm">

<i class="bi bi-arrow-left"></i>
Back

</a>


</div>





<div class="card-body">


<form action="{{ route('course.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf



<div class="row">



<!-- Course Title -->

<div class="col-md-6 mb-3">

<label class="form-label">
Course Title
</label>


<input type="text"
name="title"
class="form-control"
placeholder="Enter course title"
value="{{ old('title') }}">


@error('title')
<div class="text-danger">
{{ $message }}
</div>
@enderror


</div>





<!-- Category -->

<div class="col-md-6 mb-3">


<label class="form-label">
Course Category
</label>


<select name="course_category_id"
class="form-select">


<option value="">
Select Category
</option>


@foreach($categories as $category)


<option value="{{ $category->id }}">

{{ $category->name }}

</option>


@endforeach


</select>


</div>







<!-- Thumbnail -->

<div class="col-md-6 mb-3">


<label class="form-label">
Course Thumbnail
</label>


<input type="file"
name="thumbnail"
class="form-control">


</div>






<!-- Price -->

<div class="col-md-3 mb-3">


<label class="form-label">
Course Price
</label>


<input type="number"
name="price"
class="form-control"
placeholder="Enter price">


</div>






<!-- Level -->

<div class="col-md-3 mb-3">


<label class="form-label">
Course Level
</label>


<select name="level"
class="form-select">


<option value="Beginner">
Beginner
</option>


<option value="Intermediate">
Intermediate
</option>


<option value="Advanced">
Advanced
</option>


</select>


</div>







<!-- Type -->

<div class="col-md-4 mb-3">


<label class="form-label">
Course Type
</label>


<select name="type"
class="form-select">


<option value="paid">
Paid
</option>


<option value="free">
Free
</option>


</select>


</div>







<!-- Status -->

<div class="col-md-4 mb-3">


<label class="form-label">
Status
</label>


<select name="status"
class="form-select">


<option value="draft">
Draft
</option>


<option value="published">
Published
</option>


<option value="inactive">
Inactive
</option>


</select>


</div>






<!-- Description -->

<div class="col-12 mb-3">


<label class="form-label">
Course Description
</label>


<textarea name="description"
rows="5"
class="form-control"
placeholder="Write course details...">{{ old('description') }}</textarea>


</div>




</div>





<button class="btn btn-success">

<i class="bi bi-check-circle"></i>
Save Course

</button>



<a href="{{ route('course.index') }}"
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
