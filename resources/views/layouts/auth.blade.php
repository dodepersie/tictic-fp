<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($title) ?? config('app.name') }} - TicTic.ID</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon.ico') }}">
    @vite('resources/css/app.css')
    <!-- AlphineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <section class="flex flex-col justify-center items-center min-h-screen px-2">
        <div class="container mx-auto max-w-lg p-6 rounded-lg shadow">
            <div class="w-full">
                @yield('auth_form')
            </div>
        </div>

        <div class="text-center mt-4 text-xs text-gray-500 font-semibold">
            &copy; 2024 TicTic.ID
        </div>
    </section>

    <script>
        feather.replace();
    </script>

    <!-- Swal2 -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11'])
</body>

</html>
