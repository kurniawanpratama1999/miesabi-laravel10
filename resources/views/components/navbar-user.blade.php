<nav class="navbar navbar-expand-lg sticky-top bg-old-brown">
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
        <li id="keranjang" class="nav-item d-flex d-none">
          <button onclick="goToKeranjang()" class="nav-link text-white">Keranjang</button>
          <span style="height: 3ch; width: 3ch;" class="d-block bg-white rounded-circle d-flex align-items-center justify-content-center">0</span>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('orders.show',2) }}">Pesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('menu.index') }}">Ulasan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
