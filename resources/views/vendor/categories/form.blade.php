
<form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @if(isset($category))
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Category Name
            </label>

            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $category->name ?? '') }}"
                   placeholder="Enter Category Name">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Slug
            </label>

            <input type="text"
                   id="slug"
                   class="form-control"
                   value="{{ old('slug', $category->slug ?? '') }}"
                   readonly>

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Category Image
            </label>

            <input type="file"
                   name="image"
                   id="image"
                   class="form-control">

        </div>

        <div class="col-md-6 text-center">

            @if(isset($category) && $category->image)

                <img id="preview"
                     src="{{ asset('uploads/categories/'.$category->image) }}"
                     class="img-thumbnail"
                     width="180">

            @else

                <img id="preview"
                     src="https://placehold.co/200x200?text=Preview"
                     class="img-thumbnail"
                     width="180">

            @endif

        </div>

        <div class="col-md-6 mt-3">

            <label>Status</label>

            <select name="status" class="form-select">

                <option value="1"
                    {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

        </div>

    </div>

    <div class="mt-4">

        <button class="btn btn-primary">

            {{ isset($category) ? 'Update Category' : 'Save Category' }}

        </button>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

</form>

