<nav class="navbar navbar-expand-lg bg-old-brown">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">MieSabi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>