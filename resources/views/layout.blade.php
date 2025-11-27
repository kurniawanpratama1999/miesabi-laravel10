<x-html title="MIESABI">
    <x-navbar>
        @if(Auth::check() && Auth::user()->role === 'user')
            <li id="Products-wraper" class="nav-item">
                <a id="Products-link" href="{{ route('u.menu.index') }}" class="nav-link {{ Route::is('u.menu.index') ? 'active' : '' }}">
                    <i id="Products-icon" class="bi bi-fork-knife"></i>
                    <span id="Products-label">Products</span>
                </a>
            </li>
            <li id="Carts-wraper" class="nav-item d-none">
                <button onclick="goToCart()" id="Carts-link" class="nav-link position-relative {{ Route::is('u.cart.index') ? 'active' : '' }}">
                    <span id="Carts-ballon" style="right: -8px; top: -3px; font-size: .8rem; width: 20px; height: 20px;" class="d-block position-absolute bg-white rounded-circle text-yellow-800 text-center"></span>
                    <i id="Carts-icon" class="bi bi-cart3"></i>
                    <span id="Carts-label">Carts</span>
                </button>
            </li>
            <li id="Orders-wraper" class="nav-item">
                <a id="Orders-link" href="{{ route('u.orders.index') }}" class="nav-link {{ Route::is('u.orders.index') ? 'active' : '' }}">
                    <i id="Orders-icon" class="bi bi-journal-text"></i>
                    <span id="Orders-label">Orders</span>
                </a>
            </li>
            <li id="Reviews-wraper" class="nav-item">
                <a id="Reviews-link" href="{{ route('u.reviews.index') }}" class="nav-link {{ Route::is('u.reviews.index') ? 'active' : '' }}">
                    <i id="Reviews-icon" class="bi bi-eye"></i>
                    <span id="Reviews-label">Reviews</span>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="nav-link">Logout</button>
                </form>
            </li>
            @endif

        @if (Auth::check() && Auth::user()->role === 'admin')
            <li id="Orders-wraper" class="nav-item">
                <a id="Orders-link" href="{{ route('a.orders.index') }}" class="nav-link {{ Route::is('a.orders.index') ? 'active' : '' }}">
                    <i id="Orders-icon" class="bi bi-journal-text"></i>
                    <span id="Orders-label">Orders</span>
                </a>
            </li>
            <li id="Reviews-wraper" class="nav-item">
                <a id="Reviews-link" href="{{ route(name: 'a.reviews.index') }}" class="nav-link {{ Route::is('a.users.index') ? 'active' : '' }}">
                    <i id="Reviews-icon" class="bi bi-eye"></i>
                    <span id="Reviews-label">Reviews</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i id="Products-icon" class="bi bi-gear"></i>
                    <span id="Products-label">Setting</span>
                </a>
                <ul class="dropdown-menu border-0" style="--bs-dropdown-bg: var(--yellow-600); --bs-dropdown-link-color: var(--yellow-50); --bs-dropdown-link-hover-color: var(--yellow-700); --bs-dropdown-link-hover-bg:var(--yellow-500); left: -35px; top: 60px">
                    <li><a class="dropdown-item" href="{{ route('a.users.index') }}">User</a></li>
                    <li><a class="dropdown-item" href="{{ route('a.logo.index') }}">Logo</a></li>
                    <li><a class="dropdown-item" href="{{ route('a.barcode.index') }}">Barcode</a></li>
                    <li><a class="dropdown-item" href="{{ route('a.deliveries.index') }}">Delivery</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('a.products.index') }}">Product</a></li>
                    <li><a class="dropdown-item" href="{{ route('a.categories.index') }}">Category</a></li>
                    <li><a class="dropdown-item" href="{{ route('a.variants.index') }}">Variant</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        @endif

        @if (!Auth::check())
            <li id="LoginRegister-wraper" class="nav-item d-flex flex-row align-items-center">
                <a id="Login-link" href="{{ route('login') }}" class="nav-link text-light {{ Route::is('a.users.index') ? 'active' : '' }}">
                    <i id="Login-icon" class="bi bi-person-circle"></i>
                    <span id="Login-label">Login</span>
                </a>
                <span class="text-light">/</span>
                <a id="Register-link" href="{{ route('register') }}" class="nav-link text-light {{ Route::is('a.users.index') ? 'active' : '' }}">
                    <span id="Register-label">Register</span>
                </a>
            </li>
        @endif
    </x-navbar>

    <x-main>
        @yield('content')
        @stack('scripts')
    </x-main>

</x-html>
