{{-- <nav class="navbar navbar-expand-lg sticky-top bg-old-brown">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="#">MieSabi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav gap-5">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('menu.index') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('menu.index') }}">Menu</a>
        </li>
        @if(Auth::check())
          <li id="cart" class="nav-item d-flex d-none">
            <button onclick="goToCart()" class="nav-link text-white">Keranjang</button>
            <span style="height: 3ch; width: 3ch;" class="d-block bg-white rounded-circle d-flex align-items-center justify-content-center">0</span>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('orders.index') }}">Pesanan</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('menu.index') }}">Ulasan</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav> --}}



<nav class="navbar navbar-dark navbar-expand-lg bg-yellow-600 fixed-top px-3">
  <a class="navbar-brand" href="#">Mie Sabi</a>
  <button class="btn-sm bg-transparent border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
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
          <a class="nav-link text-white" href="{{ route('menu.index') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('menu.index') }}">Menu</a>
        </li>
        @if(Auth::check())
          <li id="cart" class="nav-item d-flex d-none">
            <button onclick="goToCart()" class="nav-link text-white">Keranjang</button>
            <span style="height: 3ch; width: 3ch;" class="d-block bg-white rounded-circle d-flex align-items-center justify-content-center">0</span>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('orders.index') }}">Pesanan</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('menu.index') }}">Ulasan</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="nav-link text-white">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>


