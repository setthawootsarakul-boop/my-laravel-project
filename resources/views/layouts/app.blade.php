<!doctype html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
    @include('layouts.nav')

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('layouts.footer')
    @include('layouts.scripts')
</body>
</html>
