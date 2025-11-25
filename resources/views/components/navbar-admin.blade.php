{{-- <nav class="navbar navbar-expand-lg sticky-top bg-old-brown">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">MieSabi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Pesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Riwayat</a>
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
            <a class="nav-link text-white" href="/a/users">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('products.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="/a/orders">Pesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Riwayat</a>
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
</nav>
