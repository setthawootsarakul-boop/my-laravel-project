<script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const cartCount = document.getElementById("cart-count");

    window.updateCartUI = function(count) {
        if (cartCount) {
            cartCount.textContent = count;
            cartCount.classList.add("updated");
            setTimeout(() => cartCount.classList.remove("updated"), 400);
        }
    };
});
</script>


<!-- ✅ Global CSRF Setup -->
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<!-- ✅ SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/slider.js') }}"></script>

@stack('scripts')
