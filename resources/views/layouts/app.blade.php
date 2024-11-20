<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- Bootstrap Select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap JS (carregado após o Bootstrap Select) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<!-- Bootstrap Select JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Styles -->
@vite(['resources/css/app.css', 'resources/js/app.js'])



</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 ">
        <!-- Sidebar -->
        <nav class="navbar">
            <ul class="navbar__menu">
                <li class="navbar__item">
                    <a href="{{ route('dashboard') }}" class="navbar__link"><i
                            data-feather="home"></i><span>Dashboard</span></a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('cursos.index') }}" class="navbar__link"><i
                            data-feather="message-square"></i><span>Cursos</span></a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('alunos.index') }}" class="navbar__link"><i
                            data-feather="users"></i><span>Alunos</span></a>
                </li>
                <li class="navbar__item">
                    <a href=" {{ __('profile') }}" class="navbar__link"><i
                            data-feather="settings"></i><span>Settings</span></a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <main class="ml-[calc(1rem*5.5)] p-4">
            {{ $slot }}
        </main>
    </div>

    <script>
        feather.replace();
    </script>
</body>

</html>

<style>
    @keyframes gooeyEffect-1 {
        0% {
            transform: scale(1, 1);
        }

        50% {
            transform: scale(0.5, 1.5);
        }

        100% {
            transform: scale(1, 1);
        }
    }

    @keyframes gooeyEffect-2 {
        0% {
            transform: scale(1, 1);
        }

        50% {
            transform: scale(0.5, 1.5);
        }

        100% {
            transform: scale(1, 1);
        }
    }

    /* Repita para outros valores conforme necessário */

    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap');

    body {
        background: #eaeef6;
        font-family: 'Open Sans', sans-serif;
    }

    .navbar {
        position: fixed;
        top: 1rem;
        left: 1rem;
        background: #fff;
        border-radius: 10px;
        padding: 1rem 0;
        box-shadow: 0 0 40px rgba(0, 0, 0, 0.03);
        height: calc(60vh - 4rem);
    }

    .navbar__link {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: calc(1rem * 3.5);
        width: calc(1rem * 5.5);
        color: #091d41;
        transition: 250ms ease all;
    }

    .navbar__link span {
        position: absolute;
        left: 100%;
        transform: translate(-3rem);
        margin-left: 1rem;
        opacity: 0;
        pointer-events: none;
        color: #406ff3;
        background: #fff;
        padding: calc(1rem * 0.75);
        transition: 250ms ease all;
        border-radius: calc(10px * 1.75);
    }

    .navbar__link:hover {
        color: #038d84;
    }

    .navbar:not(:hover) .navbar__link:focus,
    .navbar__link:hover span {
        opacity: 1;
        transform: translate(0);
    }

    .navbar__menu {
        position: relative;
    }

    .navbar__item:last-child:before {
        content: '';
        position: absolute;
        opacity: 0;
        z-index: -1;
        top: 0;
        left: 1rem;
        width: calc(1rem * 3.5);
        height: calc(1rem * 3.5);
        background: #406ff3;
        border-radius: calc(10px * 1.75);
        transition: 250ms cubic-bezier(1, 0.2, 0.1, 1.2) all;
    }

    .navbar__item:first-child:nth-last-child(1),
    .navbar__item:first-child:nth-last-child(1)~.navbar__item {
        .navbar__item:hover~.navbar__item:last-child:before {
            opacity: 1;
        }

        .navbar__item:last-child:hover:before {
            opacity: 1;
            animation: gooeyEffect-1 250ms 1;
        }
    }
</style>
