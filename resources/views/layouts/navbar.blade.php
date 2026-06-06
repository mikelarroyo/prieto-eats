<nav class="pe-navbar">
    <div class="container">

        {{-- Logo --}}
        <a href="{{ route('home_prieto') }}" class="pe-logo">
            <img src="{{ asset('img/logo.png') }}" alt="Prieto Eats" class="pe-logo-img">
            Prieto<strong>Eats</strong>
        </a>

        {{-- Links --}}
        <div class="pe-nav-links">

            <a href="{{ route('home_prieto') }}" class="pe-nav-item">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>

            @auth

            @php
                $carritoNav = session('cart', []);
                $totalItems = 0;
                foreach ($carritoNav as $articulos) {
                    $totalItems += array_sum($articulos);
                }
            @endphp

            <a href="{{ route('cartShow') }}" class="pe-nav-item">
                <div class="pe-cart-wrap">
                    <i class="fas fa-shopping-bag"></i>
                    @if($totalItems > 0)
                        <span class="pe-cart-badge">{{ $totalItems }}</span>
                    @endif
                </div>
                <span>Carrito</span>
            </a>

            {{-- User dropdown --}}
            <div class="pe-dropdown">
                <div class="pe-user-chip">
                    <div class="pe-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down" style="font-size:.65rem; opacity:.7;"></i>
                </div>

                <div class="pe-dropdown-menu">
                    <a href="{{ route('ordersShow') }}" class="pe-dropdown-item">
                        <i class="fas fa-receipt"></i> Mis pedidos
                    </a>

                    @if(Auth::user()->is_admin)
                        <div class="pe-dropdown-divider"></div>
                        <p style="font-size:.72rem; font-weight:700; color:#aaa; padding:6px 12px 2px; margin:0; text-transform:uppercase; letter-spacing:.6px;">Admin</p>
                        <a href="{{ route('admin.products.index') }}" class="pe-dropdown-item">
                            <i class="fas fa-box"></i> Productos
                        </a>
                        <a href="{{ route('admin.offers.index') }}" class="pe-dropdown-item">
                            <i class="fas fa-tags"></i> Ofertas
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="pe-dropdown-item">
                            <i class="fas fa-list-alt"></i> Pedidos admin
                        </a>
                    @endif

                    <div class="pe-dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout_prieto') }}">
                        @csrf
                        <button type="submit" class="pe-dropdown-item" style="color:#e74c3c;">
                            <i class="fas fa-sign-out-alt" style="color:#e74c3c;"></i> Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

            @else

            <a href="{{ route('login_prieto') }}" class="pe-auth-link">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </a>
            <a href="{{ route('register_prieto') }}" class="pe-auth-link register">
                <i class="fas fa-user-plus"></i> Registro
            </a>

            @endauth
        </div>
    </div>
</nav>
