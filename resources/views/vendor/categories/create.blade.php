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
            <i class="bi bi-plus-circle"></i>
            {{ isset($category) ? 'Edit Category' : 'Add Category' }}
        </h4>

        <small class="text-muted">
            {{ isset($category) ? 'Update product category' : 'Create a new product category' }}
        </small>
    </div>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>

</div>

        <div class="card-body">
        @include('vendor.categories.form')

        </div>

    </div>

</div>

</div>
<script>

// Auto Slug

document.querySelector('[name=name]').addEventListener('keyup',function(){

    document.getElementById('slug').value=
    this.value.toLowerCase()
              .replace(/ /g,'-')
              .replace(/[^\w-]+/g,'');

});

// Image Preview

image.onchange = evt => {

    preview.src = URL.createObjectURL(evt.target.files[0]);

}

</script>
</body>
</html>
