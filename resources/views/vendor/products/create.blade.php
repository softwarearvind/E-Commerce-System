```blade
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
                    <i class="bi bi-box-seam"></i>
                    {{ isset($product) ? 'Edit Product' : 'Add Product' }}
                </h4>

                <small class="text-muted">
                    {{ isset($product) ? 'Update Product Details' : 'Create New Product' }}
                </small>

            </div>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i> Back

            </a>

        </div>

        <div class="card-body">

            @include('vendor.products.form')

        </div>

    </div>

</div>

<script>

// Thumbnail Preview

document.getElementById('thumbnail')?.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        document.getElementById('preview').src = URL.createObjectURL(file);

    }

});

</script>

</body>

</html>
```
