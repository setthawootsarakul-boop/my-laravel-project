<!doctype html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- 🌐 Navbar --}}
    @include('layouts.nav')

    {{-- 🧭 Main Content --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>

    {{-- ⚓ Footer --}}
    @include('layouts.footer')

    {{-- 🧩 Global Scripts --}}
    @include('layouts.scripts')

    {{-- 🧠 Page-Specific Scripts (เช่น AJAX Filter, JS พิเศษของหน้า Home) --}}
    @stack('scripts')
</body>
</html>
