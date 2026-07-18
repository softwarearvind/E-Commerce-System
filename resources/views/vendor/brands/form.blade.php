
<form action="{{ isset($brand) ? route('brands.update', $brand->id) : route('brands.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @if(isset($brand))
        @method('PUT')
    @endif

    <div class="row">

        <!-- Brand Name -->
        <div class="col-md-6 mb-3">

            <label class="form-label">
                Brand Name <span class="text-danger">*</span>
            </label>

            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $brand->name ?? '') }}"
                   placeholder="Enter Brand Name">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Slug -->
        <div class="col-md-6 mb-3">

            <label class="form-label">
                Slug
            </label>

            <input type="text"
                   id="slug"
                   class="form-control"
                   value="{{ old('slug', $brand->slug ?? '') }}"
                   readonly>

        </div>

        <!-- Logo -->
        <div class="col-md-6 mb-3">

            <label class="form-label">
                Brand Logo
            </label>

            <input type="file"
                   id="image"
                   name="logo"
                   class="form-control @error('logo') is-invalid @enderror">

            @error('logo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Preview -->
        <div class="col-md-6 mb-3 text-center">

            @if(isset($brand) && $brand->logo)

                <img id="preview"
                     src="{{ asset('uploads/brands/'.$brand->logo) }}"
                     class="img-thumbnail"
                     width="180">

            @else

                <img id="preview"
                     src="https://placehold.co/180x180?text=Logo"
                     class="img-thumbnail"
                     width="180">

            @endif

        </div>

        <!-- Status -->
        <div class="col-md-6 mb-4">

            <label class="form-label">
                Status
            </label>

            <select name="status" class="form-select">

                <option value="1"
                    {{ old('status', $brand->status ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $brand->status ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

        </div>

    </div>

    <div class="text-end">

        <button type="submit" class="btn btn-primary">

            <i class="bi bi-check-circle"></i>

            {{ isset($brand) ? 'Update Brand' : 'Save Brand' }}

        </button>

    </div>

</form>
