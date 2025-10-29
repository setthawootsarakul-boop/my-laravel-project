@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<!-- 🍽️ HEADER -->
<section class="menu-header text-center text-white py-5 mb-5">
    <div class="menu-overlay"></div>
    <div class="container position-relative">
        <h1 class="fw-bold display-5">Our Delicious Menu</h1>
        <p class="lead">เมนูทั้งหมดที่เราภูมิใจนำเสนอ — สดใหม่ทุกวัน อร่อยทุกคำ ❤️</p>
    </div>
</section>

<!-- 🍔 MENU GRID -->
<div class="container pb-5">
    <div class="row justify-content-center">
        @foreach($menu as $item)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="menu-card border-0 h-100 shadow-lg rounded-4 overflow-hidden">
                    <div class="menu-card-img position-relative">
                        <img src="{{ asset('images/' . $item->image) }}" 
                             class="img-fluid w-100" 
                             alt="{{ $item->name }}"
                             style="object-fit: cover; height: 230px;">
                        <span class="menu-card-category position-absolute top-0 start-0 bg-accent text-dark px-3 py-1 rounded-end shadow-sm">
                            {{ ucfirst($item->category) }}
                        </span>
                    </div>
                    <div class="menu-card-body text-center p-4">
                        <h5 class="fw-bold text-primary-dark mb-2">{{ $item->name }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($item->description, 80) }}</p>
                        <div class="fw-bold text-accent fs-5 mb-3">{{ number_format($item->price, 2) }} ฿</div>
                        <button class="btn btn-accent rounded-pill px-4 py-2 add-to-cart shadow-sm" data-id="{{ $item->id }}">
                            🛒 สั่งเลย
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $menu->links() }}
    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();
        const btn = $(this);
        const id = btn.data('id');

        if (btn.prop('disabled')) return;

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: { 
                _token: "{{ csrf_token() }}",
                menu_item_id: id 
            },
            beforeSend: function() {
                btn.prop('disabled', true)
                   .html('<i class="bi bi-hourglass-split"></i> กำลังเพิ่ม...');
            },
            success: function (res) {
                btn.prop('disabled', false).html('🛒 สั่งเลย');

                if (res.success) {
                    updateCartCount(res.cart_count);
                }

                Swal.fire({
                    icon: res.success ? 'success' : 'error',
                    title: res.message,
                    showConfirmButton: false,
                    timer: 1400,
                    backdrop: `rgba(13, 51, 140, 0.2)`
                });
            },
            error: function () {
                btn.prop('disabled', false).html('🛒 สั่งเลย');
                Swal.fire({
                    icon: 'error',
                    title: '⚠️ เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    backdrop: `rgba(13, 51, 140, 0.2)`
                });
            }
        });
    });
});
</script>
@endpush
