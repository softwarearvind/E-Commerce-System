<!DOCTYPE html>
<html lang="en">

@include('layouts.link')

<body>

@include('layouts.sidebar')

<div class="main-content">

@include('layouts.top')

@include('layouts.massage')


<div class="container-fluid mt-4">


<!-- Header -->

<div class="card shadow-sm border-0 mb-4">

<div class="card-body d-flex justify-content-between align-items-center">


<div>

<h4 class="mb-1">
<i class="bi bi-book-half text-primary"></i>
Courses
</h4>

<small class="text-muted">
Manage your courses
</small>

</div>


<a href="{{ route('course.create') }}"
class="btn btn-primary">

<i class="bi bi-plus-circle"></i>
Add Course

</a>


</div>

</div>





<!-- Filter -->

<div class="card shadow-sm border-0 mb-4">

<div class="card-body">


<form method="GET"
action="{{ route('course.index') }}">


<div class="row g-3">


<!-- Search -->

<div class="col-md-4">

<label class="form-label">
Search Course
</label>

<input type="text"
name="search"
class="form-control"
placeholder="Search course name..."
value="{{ request('search') }}">

</div>



<!-- Category -->

<div class="col-md-3">

<label class="form-label">
Course Category
</label>


<select name="category"
class="form-select">


<option value="">
All Categories
</option>


@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ request('category')==$category->id?'selected':'' }}>

{{ $category->name }}

</option>

@endforeach


</select>


</div>





<!-- Type -->

<div class="col-md-2">

<label class="form-label">
Type
</label>


<select name="type"
class="form-select">


<option value="">
All
</option>


<option value="paid">
Paid
</option>


<option value="free">
Free
</option>


</select>


</div>




<!-- Status -->

<div class="col-md-2">

<label class="form-label">
Status
</label>


<select name="status"
class="form-select">


<option value="">
All
</option>


<option value="published">
Published
</option>


<option value="draft">
Draft
</option>


</select>


</div>




<div class="col-md-1 d-flex align-items-end">


<button class="btn btn-primary w-100">

<i class="bi bi-search"></i>

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

<th>Thumbnail</th>

<th>Course</th>

<th>Category</th>

<th>Price</th>

<th>Type</th>

<th>Status</th>

<th width="160">
Action
</th>


</tr>


</thead>



<tbody>


@forelse($courses as $course)


<tr>


<td>
{{ $loop->iteration }}
</td>



<td>


@if($course->thumbnail)

<img src="{{ asset('storage/'.$course->thumbnail) }}"
width="60"
height="60"
class="rounded object-fit-cover">


@else

<img src="https://via.placeholder.com/60">

@endif


</td>




<td>

<strong>
{{ $course->title }}
</strong>

<br>

<small class="text-muted">
{{ Str::limit($course->description,40) }}
</small>


</td>




<td>

<span class="badge bg-info">

{{ $course->category->name }}

</span>

</td>



<td>

₹{{ number_format($course->price,2) }}

</td>



<td>


@if($course->type=='paid')

<span class="badge bg-success">
Paid
</span>

@else

<span class="badge bg-secondary">
Free
</span>

@endif


</td>



<td>


@if($course->status=='published')

<span class="badge bg-success">
Published
</span>


@elseif($course->status=='draft')

<span class="badge bg-warning text-dark">
Draft
</span>


@else

<span class="badge bg-danger">
Inactive
</span>


@endif


</td>




<td>


<a href="{{ route('course.edit',$course->id) }}"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil"></i>

</a>



<form action="{{ route('course.destroy',$course->id) }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')


<button class="btn btn-danger btn-sm"
onclick="return confirm('Delete Course?')">

<i class="bi bi-trash"></i>

</button>


</form>


</td>


</tr>


@empty


<tr>

<td colspan="8"
class="text-center py-4">

No Courses Found

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
