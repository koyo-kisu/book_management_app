@if (session('flash_success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('flash_success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if (session('flash_warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('flash_warning') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
