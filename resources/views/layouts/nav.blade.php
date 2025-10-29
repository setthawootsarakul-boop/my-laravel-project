<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
    <div class="container">
        <!-- 🍗 Logo -->
        <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="" width="35" class="me-2">
            <span class="text-primary-dark">
                Fry<span class="text-accent">Grill</span>
            </span>
        </a>

        <!-- 📱 Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- 🧭 Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" 
                       href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" 
                       href="{{ route('menu') }}">Menu</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}" 
                       href="{{ route('reviews') }}">Reviews</a>
                </li>

                <!-- 🛒 Cart -->
                <li class="nav-item mx-2">
                    <a href="{{ route('cart.index') }}" id="cart-button"
                       class="nav-link d-flex align-items-center {{ request()->routeIs('cart.index') ? 'active' : '' }}">
                        <i class="bi bi-cart3 fs-5 me-2"></i>
                        <span>Cart</span>
                        @php 
                            $cartCount = session('cart_count', \App\Models\CartItem::sum('quantity')); 
                        @endphp
                        <span id="cart-count">{{ $cartCount }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    // ✅ ฟังก์ชันอัปเดตจำนวนสินค้าในตะกร้า
    window.updateCartCount = function(count) {
        const badge = document.getElementById('cart-count');
        if (badge) badge.textContent = count;
    };
});
</script>
@endpush
