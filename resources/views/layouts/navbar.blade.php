<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Prieto Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background-color: #28a745;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 40px;
            color: white;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 22px;
            font-weight: bold;
        }

        .logo-img {
            height: 40px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-item {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .nav-item:hover {
            opacity: 0.85;
        }

        /* DROPDOWN */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 120%;
            background-color: #28a745;
            min-width: 220px;
            border-radius: 6px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            padding: 8px 0;
            z-index: 999;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            color: white;
            text-decoration: none;
            font-size: 15px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .dropdown-divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.3);
            margin: 6px 0;
        }

        .btn-link {
            background: none;
            border: none;
            padding: 0;
            font: inherit;
            color: inherit;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        {{-- LOGO --}}
        <div class="logo-container">
            <img src="{{ asset('img/logo.png') }}" alt="Prieto Eats" class="logo-img">
            <span>Prieto Eats</span>
        </div>

        {{-- LINKS --}}
        <div class="nav-links">

            {{-- VOLVER A HOME --}}
            <a href="{{ route('home_prieto') }}" class="nav-item">
                <i class="fas fa-house"></i> Inicio
            </a>

            @auth
            
            @php
                $carritoNav = session('cart', []);
                $totalItems = 0;
                foreach ($carritoNav as $articulos) {
                    $totalItems += array_sum($articulos);
                }
            @endphp
            <a href="{{ route('cartShow') }}" class="nav-item">
                <i class="fas fa-shopping-cart"></i> Carrito
                @if($totalItems > 0)
                    ({{ $totalItems }})
                @endif
            </a>


            {{-- USUARIO --}}
            <div class="dropdown">
                <div class="nav-item">
                    <i class="fas fa-user"></i>
                    {{ Auth::user()->name }}
                    <i class="fas fa-caret-down"></i>
                </div>

                <div class="dropdown-menu">
                    <a href="{{ route('ordersShow') }}" class="dropdown-item">
                        <i class="fas fa-receipt"></i> Mis pedidos
                    </a>

                    @if(Auth::user()->is_admin)
                    <div class="dropdown-divider"></div>

                    <a href="{{ route('admin.products.index') }}" class="dropdown-item">
                        <i class="fas fa-box"></i> Productos
                    </a>

                    <a href="{{ route('admin.offers.index') }}" class="dropdown-item">
                        <i class="fas fa-tags"></i> Ofertas
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="dropdown-item">
                        <i class="fas fa-list-alt"></i> Pedidos
                    </a>
                    {{--@php
                    $cartCount =
                    array_sum(array_column(session('cart', ['items' => []])['items'], 'qty')); @endphp--}}
                    {{--<a href="{{ route('cartShow') }}" class="nav-item">
                    <i class="fas fa-shopping-cart"></i> Carrito
                    @if($cartCount > 0)
                    ({{ $cartCount }})
                    @endif
                    </a>--}}
                    @endif

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout_prieto') }}">
                        @csrf
                        <button type="submit" class="dropdown-item btn-link">
                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login_prieto') }}" class="nav-item">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>

            <a href="{{ route('register_prieto') }}" class="nav-item">
                <i class="fas fa-user-plus"></i> Registrarse
            </a>

            @endauth
        </div>
    </nav>

</body>

</html>
