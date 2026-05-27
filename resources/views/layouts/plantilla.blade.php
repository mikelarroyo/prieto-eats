<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prieto Eats - Gestión de Menús</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .bg-prieto {
            background-color: #2eab4f !important;
        }
        .text-prieto {
            color: #2eab4f !important;
        }
        .btn-prieto {
            background-color: #2eab4f;
            color: white;
            border: none;
        }
        .btn-prieto:hover {
            background-color: #258a40;
            color: white;
        }
        .btn-outline-prieto {
            border: 2px solid #2eab4f;
            color: #2eab4f;
            font-weight: bold;
        }
        .btn-outline-prieto:hover {
            background-color: #2eab4f;
            color: white;
        }
        body {
            background-color: #f8f9fa; /* Gris clarito de fondo */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-white text-center py-4 mt-auto border-top">
        <div class="container">
            <p class="mb-0 text-muted">
                &copy; {{ date('Y') }} <span class="text-prieto fw-bold">Prieto Eats</span>. Todos los derechos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
