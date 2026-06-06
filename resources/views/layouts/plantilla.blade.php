<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prieto Eats</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ── Variables ─────────────────────────────── */
        :root {
            --pe-green:        #2eab4f;
            --pe-green-dark:   #1e7a38;
            --pe-green-deep:   #1a5c2e;
            --pe-green-light:  #e8f5ed;
            --pe-gold:         #f0a500;
            --pe-bg:           #f3f7f4;
            --pe-text:         #1a2e1f;
            --pe-muted:        #6b7c6e;
            --pe-radius:       14px;
            --pe-radius-sm:    8px;
            --pe-shadow:       0 2px 16px rgba(0,0,0,0.07);
            --pe-shadow-lg:    0 8px 32px rgba(46,171,79,0.16);
        }

        /* ── Base ───────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--pe-bg);
            color: var(--pe-text);
            min-height: 100vh;
        }

        /* ── Navbar ─────────────────────────────────── */
        .pe-navbar {
            position: sticky;
            top: 0;
            z-index: 1040;
            background: linear-gradient(135deg, var(--pe-green-deep) 0%, var(--pe-green-dark) 100%);
            box-shadow: 0 2px 20px rgba(0,0,0,0.18);
        }
        .pe-navbar .container {
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .pe-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 300;
            letter-spacing: -0.5px;
            transition: opacity 0.2s;
        }
        .pe-logo:hover { opacity: 0.9; color: white; }
        .pe-logo strong { font-weight: 700; }
        .pe-logo-img {
            height: 36px;
            width: 36px;
            object-fit: contain;
            border-radius: 8px;
            background: rgba(255,255,255,0.15);
            padding: 3px;
        }
        .pe-nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .pe-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1px;
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            padding: 7px 13px;
            border-radius: 10px;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.2px;
            cursor: pointer;
            transition: background 0.18s ease, color 0.18s ease;
        }
        .pe-nav-item i, .pe-nav-item .fa { font-size: 1.05rem; }
        .pe-nav-item:hover {
            background: rgba(255,255,255,0.14);
            color: white;
        }
        .pe-nav-item.active-nav {
            background: rgba(255,255,255,0.18);
            color: white;
        }

        /* Cart badge */
        .pe-cart-wrap { position: relative; display: inline-flex; }
        .pe-cart-badge {
            position: absolute;
            top: -7px; right: -9px;
            background: var(--pe-gold);
            color: white;
            border-radius: 20px;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
            font-size: 0.65rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        /* User chip */
        .pe-user-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px 6px 8px;
            border-radius: 30px;
            background: rgba(255,255,255,0.14);
            color: white;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.18s;
            border: 1.5px solid rgba(255,255,255,0.18);
        }
        .pe-user-chip:hover { background: rgba(255,255,255,0.22); color: white; }
        .pe-avatar {
            width: 28px; height: 28px;
            background: var(--pe-green);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Dropdown */
        .pe-dropdown { position: relative; }
        .pe-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            background: white;
            min-width: 210px;
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.14);
            padding: 8px;
            z-index: 1050;
            animation: fadeDown 0.18s ease;
        }
        .pe-dropdown:hover .pe-dropdown-menu { display: block; }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .pe-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            color: var(--pe-text);
            text-decoration: none;
            font-size: 0.86rem;
            font-weight: 500;
            border-radius: 9px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background 0.15s;
        }
        .pe-dropdown-item:hover {
            background: var(--pe-green-light);
            color: var(--pe-green-dark);
        }
        .pe-dropdown-item i, .pe-dropdown-item .fa {
            width: 16px;
            text-align: center;
            color: var(--pe-green);
            font-size: 0.9rem;
        }
        .pe-dropdown-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 6px 0;
        }

        /* Auth links */
        .pe-auth-link {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.18s;
        }
        .pe-auth-link:hover { background: rgba(255,255,255,0.14); color: white; }
        .pe-auth-link.register {
            background: rgba(255,255,255,0.18);
            border: 1.5px solid rgba(255,255,255,0.3);
        }
        .pe-auth-link.register:hover { background: rgba(255,255,255,0.28); color: white; }

        /* ── Cards ──────────────────────────────────── */
        .card {
            border: none;
            border-radius: var(--pe-radius);
            box-shadow: var(--pe-shadow);
        }
        .card-lift {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .card-lift:hover {
            transform: translateY(-5px);
            box-shadow: var(--pe-shadow-lg);
        }

        /* ── Buttons ────────────────────────────────── */
        .btn {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            border-radius: var(--pe-radius-sm);
            transition: all 0.2s ease;
        }
        .btn-prieto {
            background: linear-gradient(135deg, var(--pe-green), var(--pe-green-dark));
            color: white;
            border: none;
            font-weight: 600;
        }
        .btn-prieto:hover, .btn-prieto:focus {
            background: linear-gradient(135deg, var(--pe-green-dark), var(--pe-green-deep));
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(46,171,79,0.35);
        }
        .btn-outline-prieto {
            border: 2px solid var(--pe-green);
            color: var(--pe-green);
            font-weight: 600;
        }
        .btn-outline-prieto:hover {
            background: var(--pe-green);
            color: white;
        }
        .btn-danger { border-radius: var(--pe-radius-sm); }
        .btn-warning { border-radius: var(--pe-radius-sm); }
        .btn-secondary { border-radius: var(--pe-radius-sm); }
        .btn-success {
            background: linear-gradient(135deg, var(--pe-green), var(--pe-green-dark));
            border: none;
            font-weight: 600;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, var(--pe-green-dark), var(--pe-green-deep));
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(46,171,79,0.3);
        }
        /* Qty buttons */
        .btn-qty {
            width: 30px; height: 30px;
            padding: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 700;
            border: none;
            background: var(--pe-green-light);
            color: var(--pe-green-dark);
            transition: all 0.15s;
        }
        .btn-qty:hover {
            background: var(--pe-green);
            color: white;
        }
        .btn-qty.remove {
            background: #fdecea;
            color: #c0392b;
        }
        .btn-qty.remove:hover { background: #e74c3c; color: white; }

        /* ── Forms ──────────────────────────────────── */
        .form-control, .form-select {
            font-family: 'Poppins', sans-serif;
            border-radius: 10px;
            border: 1.5px solid #dce8de;
            padding: 10px 14px;
            font-size: 0.92rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #fafffe;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--pe-green);
            box-shadow: 0 0 0 3px rgba(46,171,79,0.12);
            background-color: white;
        }
        .form-label {
            font-weight: 500;
            font-size: 0.88rem;
            color: #445744;
            margin-bottom: 5px;
        }
        .form-check-input:checked {
            background-color: var(--pe-green);
            border-color: var(--pe-green);
        }

        /* ── Tables ─────────────────────────────────── */
        .table-card {
            background: white;
            border-radius: var(--pe-radius);
            overflow: hidden;
            box-shadow: var(--pe-shadow);
        }
        .table { margin-bottom: 0; }
        .table thead th {
            background: var(--pe-green-light);
            color: var(--pe-green-dark);
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border: none;
            padding: 14px 18px;
        }
        .table tbody td {
            vertical-align: middle;
            border-color: #f2f5f2;
            padding: 13px 18px;
            font-size: 0.9rem;
        }
        .table tbody tr:hover { background: #fafff9; }
        .table-dark thead th {
            background: var(--pe-green-dark);
            color: white;
        }

        /* ── Alerts ─────────────────────────────────── */
        .alert {
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 12px 18px;
        }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-info    { background: #d1ecf1; color: #0c5460; }
        .alert-danger  { background: #f8d7da; color: #721c24; }
        .alert-warning { background: #fff3cd; color: #856404; }

        /* ── Tabs ───────────────────────────────────── */
        .nav-tabs {
            border-bottom: 2px solid var(--pe-green-light);
            gap: 4px;
        }
        .nav-tabs .nav-link {
            border: none;
            border-radius: 10px 10px 0 0;
            color: var(--pe-muted);
            font-weight: 500;
            font-size: 0.88rem;
            padding: 10px 20px;
            transition: all 0.18s;
        }
        .nav-tabs .nav-link:hover {
            color: var(--pe-green);
            background: var(--pe-green-light);
        }
        .nav-tabs .nav-link.active {
            color: var(--pe-green-dark);
            background: var(--pe-green-light);
            font-weight: 600;
            border-bottom: 3px solid var(--pe-green);
        }
        .tab-content {
            background: white;
            border-radius: 0 0 var(--pe-radius) var(--pe-radius);
        }

        /* ── Page header ────────────────────────────── */
        .pe-page-header {
            background: linear-gradient(135deg, var(--pe-green-deep), var(--pe-green-dark));
            color: white;
            padding: 36px 0 28px;
            margin-bottom: 32px;
        }
        .pe-page-header h1, .pe-page-header h2 {
            font-weight: 700;
            margin-bottom: 4px;
            font-size: 1.8rem;
        }
        .pe-page-header p { opacity: 0.78; margin: 0; font-size: 0.92rem; }
        .pe-page-header .badge {
            background: rgba(255,255,255,0.2);
            font-weight: 500;
            font-size: 0.78rem;
            padding: 5px 12px;
            border-radius: 20px;
        }

        /* ── Hero ───────────────────────────────────── */
        .pe-hero {
            background: linear-gradient(135deg, var(--pe-green-deep) 0%, var(--pe-green) 65%, #4dc978 100%);
            padding: 52px 0 44px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .pe-hero::after {
            content: '';
            position: absolute;
            bottom: -30px; right: -30px;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .pe-hero::before {
            content: '';
            position: absolute;
            top: -50px; left: -50px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }
        .pe-hero h1 {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 10px;
        }
        .pe-hero h1 em {
            font-style: normal;
            color: #a8f5c4;
        }
        .pe-hero p {
            font-size: 1rem;
            opacity: 0.85;
            font-weight: 300;
        }
        .pe-hero-icon {
            font-size: 4rem;
            opacity: 0.3;
            text-align: right;
        }

        /* ── Offer info bar ─────────────────────────── */
        .pe-offer-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 12px 16px;
            background: var(--pe-green-light);
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--pe-green-dark);
        }
        .pe-offer-meta .deadline {
            color: #c0392b;
            font-weight: 600;
        }

        /* ── Cart ───────────────────────────────────── */
        .pe-cart-section {
            background: white;
            border-radius: var(--pe-radius);
            box-shadow: var(--pe-shadow);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .pe-cart-section-header {
            background: linear-gradient(90deg, var(--pe-green-light), #f8fff8);
            padding: 14px 20px;
            border-bottom: 1px solid #e8f5ed;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .pe-cart-section-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--pe-green-dark);
            font-size: 0.95rem;
        }
        .pe-cart-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 20px;
            border-bottom: 1px solid #f5f5f5;
            transition: background 0.15s;
        }
        .pe-cart-row:last-child { border-bottom: none; }
        .pe-cart-row:hover { background: #fafff9; }
        .pe-cart-img {
            width: 60px; height: 60px;
            object-fit: cover;
            border-radius: 10px;
            flex-shrink: 0;
            background: var(--pe-green-light);
        }
        .pe-cart-img-placeholder {
            width: 60px; height: 60px;
            border-radius: 10px;
            background: var(--pe-green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pe-green);
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .pe-cart-info { flex: 1; min-width: 0; }
        .pe-cart-info .name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--pe-text);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .pe-cart-info .price {
            font-size: 0.82rem;
            color: var(--pe-muted);
        }
        .pe-qty-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .pe-qty-num {
            font-weight: 700;
            font-size: 1rem;
            min-width: 24px;
            text-align: center;
        }
        .pe-line-total {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--pe-green-dark);
            min-width: 70px;
            text-align: right;
        }
        .pe-cart-summary {
            background: white;
            border-radius: var(--pe-radius);
            box-shadow: var(--pe-shadow);
            padding: 24px;
        }
        .pe-cart-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 0.92rem;
        }
        .pe-cart-total-row.grand {
            border-top: 2px solid var(--pe-green-light);
            margin-top: 8px;
            padding-top: 16px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--pe-green-dark);
        }

        /* ── Orders ─────────────────────────────────── */
        .pe-order-card {
            background: white;
            border-radius: var(--pe-radius);
            box-shadow: var(--pe-shadow);
            overflow: hidden;
            margin-bottom: 20px;
            transition: box-shadow 0.2s;
        }
        .pe-order-card:hover { box-shadow: var(--pe-shadow-lg); }
        .pe-order-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            background: linear-gradient(90deg, var(--pe-green-light), #f8fff8);
            border-bottom: 1px solid #e8f5ed;
        }
        .pe-order-header .order-id {
            font-weight: 700;
            font-size: 1rem;
            color: var(--pe-green-dark);
        }
        .pe-order-header .order-date {
            font-size: 0.8rem;
            color: var(--pe-muted);
            margin-top: 1px;
        }
        .pe-order-total {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--pe-green-dark);
            background: var(--pe-green-light);
            padding: 6px 14px;
            border-radius: 20px;
        }

        /* ── Auth ───────────────────────────────────── */
        .pe-auth-wrap {
            min-height: calc(100vh - 68px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }
        .pe-auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 460px;
        }
        .pe-auth-header {
            background: linear-gradient(135deg, var(--pe-green-deep), var(--pe-green));
            padding: 36px 40px 28px;
            text-align: center;
            color: white;
        }
        .pe-auth-header .brand-icon {
            width: 60px; height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 1.6rem;
        }
        .pe-auth-header h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
        }
        .pe-auth-header p {
            opacity: 0.8;
            font-size: 0.85rem;
            margin-top: 4px;
            margin-bottom: 0;
        }
        .pe-auth-body { padding: 32px 40px; }

        /* ── Admin ──────────────────────────────────── */
        .pe-admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .pe-admin-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }
        .pe-section-card {
            background: white;
            border-radius: var(--pe-radius);
            box-shadow: var(--pe-shadow);
            padding: 28px 32px;
        }

        /* ── Pagination ─────────────────────────────── */
        .pagination .page-link {
            border-radius: 8px;
            margin: 0 2px;
            color: var(--pe-green);
            border: 1.5px solid #dce8de;
            font-weight: 500;
            font-size: 0.88rem;
            transition: all 0.15s;
        }
        .pagination .page-link:hover {
            background: var(--pe-green-light);
            border-color: var(--pe-green);
        }
        .pagination .page-item.active .page-link {
            background: var(--pe-green);
            border-color: var(--pe-green);
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            color: #ccc;
            border-color: #eee;
        }

        /* ── Utilities ──────────────────────────────── */
        .text-prieto  { color: var(--pe-green) !important; }
        .bg-prieto    { background-color: var(--pe-green) !important; }
        .bg-prieto-light { background-color: var(--pe-green-light) !important; }
        .fw-600 { font-weight: 600; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeInUp 0.35s ease both; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="mt-auto" style="background:white; border-top:1px solid var(--pe-green-light); padding:22px 0;">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
            <p class="mb-0" style="font-size:.85rem; color:var(--pe-muted);">
                &copy; {{ date('Y') }} <strong class="text-prieto">Prieto Eats</strong>. Todos los derechos reservados.
            </p>
            <p class="mb-0" style="font-size:.8rem; color:#bbb;">Comida fresca, recogida local.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
