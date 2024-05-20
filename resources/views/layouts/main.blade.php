<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($title) ?? config('app.name') }} - TicTic.ID</title>
    @vite('resources/css/app.css')
    <!-- AlphineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <x-navbar></x-navbar>

    <div>
        @yield('container')
    </div>

    <x-footer></x-footer>
    <button x-data="{ showButton: false }" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        @scroll.window="showButton = (window.scrollY > 0)" x-show="showButton"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-1/2"
        class="fixed bottom-4 right-4 shadow border p-3 rounded-full bg-white">
        <i data-feather="chevron-up"></i>
    </button>

    <script>
        feather.replace();
    </script>

    <!-- Swal2 -->
    @include('sweetalert::alert')
</body>

</html>
