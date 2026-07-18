
<form action="{{ isset($product) ? route('products.update',$product->id) : route('products.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @isset($product)
        @method('PUT')
    @endisset

    <div class="row">

        <!-- Product Name -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Name <span class="text-danger">*</span></label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name',$product->name ?? '') }}"
                   placeholder="Enter Product Name">
        </div>

        <!-- SKU -->
        <div class="col-md-6 mb-3">
            <label class="form-label">SKU</label>

            <input type="text"
                   name="sku"
                   class="form-control"
                   value="{{ old('sku',$product->sku ?? '') }}"
                   placeholder="SKU">
        </div>

        <!-- Category -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Category</label>

            <select name="category_id" class="form-select">

                <option value="">Select Category</option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ old('category_id',$product->category_id ?? '')==$category->id ? 'selected':'' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>
        </div>

        <!-- Brand -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Brand</label>

            <select name="brand_id" class="form-select">

                <option value="">Select Brand</option>

                @foreach($brands as $brand)

                    <option value="{{ $brand->id }}"
                        {{ old('brand_id',$product->brand_id ?? '')==$brand->id ? 'selected':'' }}>

                        {{ $brand->name }}

                    </option>

                @endforeach

            </select>
        </div>

        <!-- Price -->
        <div class="col-md-4 mb-3">
            <label class="form-label">Price</label>

            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="{{ old('price',$product->price ?? '') }}">
        </div>

        <!-- Sale Price -->
        <div class="col-md-4 mb-3">
            <label class="form-label">Sale Price</label>

            <input type="number"
                   step="0.01"
                   name="sale_price"
                   class="form-control"
                   value="{{ old('sale_price',$product->sale_price ?? '') }}">
        </div>

        <!-- Stock -->
        <div class="col-md-4 mb-3">
            <label class="form-label">Stock</label>

            <input type="number"
                   name="stock"
                   class="form-control"
                   value="{{ old('stock',$product->stock ?? '') }}">
        </div>

        <!-- Thumbnail -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Thumbnail</label>

            <input type="file"
                   name="thumbnail"
                   id="thumbnail"
                   class="form-control">
        </div>

        <!-- Gallery -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Gallery Images</label>

            <input type="file"
                   name="gallery[]"
                   class="form-control"
                   multiple>
        </div>

        <!-- Description -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>

            <textarea name="description" id="description"  rows="5" class="form-control">{{ old('description',$product->description ?? '') }}</textarea>
        </div>

        <!-- AI Button -->
        <div class="col-md-12 mb-3">
            <button type="button" id="generateAI" class="btn btn-info mt-2">
                🤖 Generate AI Description
            </button>

        </div>

        <!-- Featured -->
        <div class="col-md-6 mb-3">

            <label class="form-label">Featured</label>

            <select name="featured" class="form-select">

                <option value="1">Yes</option>

                <option value="0">No</option>

            </select>

        </div>

        <!-- Status -->
        <div class="col-md-6 mb-3">

            <label class="form-label">Status</label>

            <select name="status" class="form-select">

                <option value="1">Active</option>

                <option value="0">Inactive</option>

            </select>

        </div>

    </div>

    <button class="btn btn-primary">
        {{ isset($product) ? 'Update Product' : 'Save Product' }}
    </button>

</form>

<script>
document.getElementById('generateAI').addEventListener('click', function () {

    fetch("{{ route('ai.generate.description') }}", {

        method: "POST",

        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },

        body: JSON.stringify({
            name: document.querySelector('[name="name"]').value
        })

    })
    .then(async response => {

        const text = await response.text();

        console.log(text);   // Server ne kya return kiya

        return JSON.parse(text);

    })
    .then(data => {

        document.getElementById('description').value = data.description;

    })
    .catch(error => console.error(error));

});
</script>
