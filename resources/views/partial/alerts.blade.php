@if (session('alert'))
    <div class="alert alert-{{ session('alert.type') }} alert-dismissible" role="alert">
        {{ session('alert.message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
