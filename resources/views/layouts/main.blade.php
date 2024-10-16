<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($title) ?? config('app.name') }} - TicTic.ID</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon.ico') }}">
    @vite('resources/css/app.css')
    <!-- AlphineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- TippyJS -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
</head>

<body>
    <x-navbar></x-navbar>

    <div class="container max-w-7xl mx-auto p-5 pt-24 lg:px-8 lg:pb-10 md:pt-36 space-y-3">
        <div>
            @yield('container')
        </div>
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
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11'])
    @stack('script')
</body>

</html>
