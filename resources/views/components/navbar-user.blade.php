<nav class="navbar navbar-dark navbar-expand-lg bg-yellow-600 fixed-top px-3">
  <a class="navbar-brand" href="#">Mie Sabi</a>
  <button class="d-lg-none btn-sm bg-transparent border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="offcanvas offcanvas-start bg-yellow-600" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">MIESABI</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-5">
        <li>
            <x-navbar-current-url bootstrapIcon="bi-house" :url="route('u.menu.index')" label="Dashboard"/>
        </li>
        <li class="d-flex flex-column align-items-center justify-content-center">
            <i class="text-white bi bi-house fs-4"></i>
            <a style="font-size: .8rem" class="nav-link text-white" href="{{ route('u.menu.index') }}">Menu</a>
        </li>
        @if(Auth::check())
          <li id="cart" class="flex-column align-items-center justify-content-center d fs-4 d-none">

            <button onclick="goToCart()">
                <i class="text-white bi bi-cart3"></i>
                <span style="font-size: .8rem" class="nav-link text-white">Keranjang</span>
            </button>
            <span style="height: 3ch; width: 3ch;" class="d-block bg-white rounded-circle d-flex align-items-center justify-content-center">0</span>
          </li>

          <li class="d-flex flex-column align-items-center justify-content-center">
            <i class="text-white bi bi-journal-text fs-4"></i>
            <a style="font-size: .8rem" class="nav-link text-white" href="{{ route('u.orders.index') }}">Pesanan</a>
        </li>
        @endif
        <li class="d-flex flex-column align-items-center justify-content-center">
            <i class="text-white bi bi-chat-right-quote fs-4"></i>
          <a style="font-size: .8rem" class="nav-link text-white" href="{{ route('u.reviews.index') }}">Ulasan</a>
        </li>
        <li class="d-flex flex-column align-items-center justify-content-center">
          <form action="{{ route('logout') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" style="font-size: .8rem" class="nav-link text-white text-white">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>


