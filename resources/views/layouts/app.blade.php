<!doctype html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
    {{-- 🌐 Navbar --}}
    @include('layouts.nav')

    {{-- 🧭 Main Content --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- ⚓ Footer --}}
    @include('layouts.footer')

    {{-- 🧩 Global Scripts --}}
    @include('layouts.scripts')

    {{-- 🧠 Page-Specific Scripts (เช่น AJAX Filter, JS พิเศษของหน้า Home) --}}
    @stack('scripts')
</body>
</html>
