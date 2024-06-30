<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? 'Dashboard'}}</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
<div class="grid-container">

    <!-- Header -->
    <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div>
    </header>
    <!-- End Header -->

    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="sidebar-title">
            <div class="sidebar-brand">
                <span class="material-icons-outlined"></span> TECMUNITY
            </div>
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
            <li class="sidebar-list-item">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="{{ route('usuarios.index') }}" class="sidebar-link">
                    <span class="material-icons-outlined">manage_accounts</span> Usuarios
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="{{ route('dashboard.denuncias.index') }}" class="sidebar-link">
                    <span class="material-icons-outlined">person_off</span> Lista de Denuncias
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="{{ route('publicaciones.index') }}" class="sidebar-link">
                    <span class="material-icons-outlined">logout</span> Volver a Tecmunity
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar -->

    <!-- Content -->
    <main class="main-container">
        <div class="content-wrapper">
            {{$slot}}
        </div>
    </main>
    <!-- End Content -->
</div>

<!-- Scripts -->
<!-- ApexCharts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
<!-- Custom JS -->
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
