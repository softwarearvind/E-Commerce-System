@if(session('success'))

<div class="alert alert-success alert-dismissible fade show shadow-sm"
     role="alert">

    <i class="bi bi-check-circle-fill me-2"></i>

    <strong>Success!</strong>
    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
    </button>

</div>

@endif
