@php
  $logo = DB::table('logos')->first();
@endphp

<nav style="height: 4rem;" class="navbar navbar-dark navbar-expand-lg bg-yellow-600 fixed-top px-3">
  <a class="nav-link text-white" href="/" class="d-flex align-items-center gap-2 p-0 m-0">
    @if(isset($logo, $logo->photo))
        <img src="{{ asset('storage/' . $logo->photo) }}" style="width: 3.5rem;" class="object-fit-contain p-0 m-0">
    @endif
    <span>MieSabi</span>
  </a>
  <button class="d-lg-none btn-sm bg-transparent border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="offcanvas offcanvas-start bg-yellow-600" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">MIESABI</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-3">
        {{ $slot }}
      </ul>
    </div>
  </div>
</nav>