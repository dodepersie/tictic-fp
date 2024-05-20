<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($title) ?? config('app.name') }} - TicTic.ID</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
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
</body>

</html>
