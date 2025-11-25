<nav class="navbar navbar-dark navbar-expand-lg bg-yellow-600 fixed-top px-3">
  <a class="navbar-brand" href="#">MIESABI</a>
  <button class="d-lg-none btn-sm bg-transparent border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="offcanvas offcanvas-start bg-yellow-600" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">MIESABI</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
