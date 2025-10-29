@extends('layouts.app')
@section('content')
@php use Illuminate\Support\Str; @endphp

<!-- 🌅 HERO HEADER -->
<section class="hero-header text-center text-white d-flex align-items-center justify-content-center">
    <div class="overlay"></div>
    <div class="content">
        <h1 class="display-3 fw-bold mb-3">FryGrill — อร่อยทุกคำ</h1>
        <p class="lead mb-4">ไก่ทอดกรอบ ไก่ย่างหอม เฟรนช์ฟรายส์สไตล์โฮมเมด</p>
        <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-5 shadow">ดูเมนูทั้งหมด</a>
    </div>
</section>

<!-- 🎠 CAROUSEL -->
<section class="py-5 bg-light">
    <div class="container">
        <div id="homeCarousel" class="carousel slide rounded shadow overflow-hidden" data-bs-ride="carousel">

            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100 carousel-img" alt="slide1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100 carousel-img" alt="slide2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100 carousel-img" alt="slide3">
                </div>
            </div>

            <!-- ❮ PREV -->
            <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                <span class="carousel-arrow">❮</span>
            </button>

            <!-- ❯ NEXT -->
            <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                <span class="carousel-arrow">❯</span>
            </button>
        </div>
    </div>
</section>

<!-- 🍗 OUR MENU SPECIALS -->
<section class="popular-section text-center">
    <div class="container">
        <h3 class="fw-bold mb-4 text-primary-dark">🍗 Our Menu Specials</h3>
        <div class="popular-row d-flex justify-content-center flex-wrap gap-4">
            @foreach($popular->take(2) as $item)
                <div class="menu-box shadow-sm border rounded-3 p-3" style="background:#fff; width:280px;">
                    <div class="menu-img position-relative">
                        <img src="{{ asset('images/' . $item->image) }}" class="img-fluid rounded" alt="{{ $item->name }}">
                        @if(property_exists($item, 'discount') && $item->discount)
                            <span class="discount-badge bg-danger text-white px-2 py-1 rounded">
                                -{{ $item->discount }}%
                            </span>
                        @endif
                    </div>
                    <div class="menu-content mt-3">
                        <h5 class="text-primary-dark">{{ $item->name }}</h5>
                        <p class="text-muted small">{{ Str::limit($item->description, 60) }}</p>
                        <div class="price fw-bold text-accent">{{ number_format($item->price, 2) }} ฿</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 🍽️ OUR MENU -->
<section class="py-5" style="background-color:#f9fbff;">
    <div class="container text-center">
        <h3 class="fw-bold mb-3 text-primary-dark">Our Delicious Menu</h3>
        <p class="text-muted mb-5">เมนูทั้งหมดที่เราภูมิใจนำเสนอ — สดใหม่ทุกวัน อร่อยทุกคำ ❤️</p>

        <!-- 🔹 CATEGORY FILTER BUTTONS -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            @foreach($categories as $cat)
                <button class="category-btn {{ $loop->first ? 'active' : '' }}" data-category="{{ $cat }}">{{ $cat }}</button>
            @endforeach
        </div>

        <!-- 🔄 Loading Spinner -->
        <div id="menu-loading" class="text-center mb-4" style="display:none;">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="text-muted mt-2">กำลังโหลดเมนู...</p>
        </div>

        <!-- 🔹 MENU DISPLAY -->
        <div id="menu-container" class="row g-4 justify-content-center">
            @include('partials.menu_cards', ['menu' => $menu])
        </div>

        <!-- ✨ ปุ่มดูเพิ่มเติม -->
        <a href="{{ route('menu') }}" class="btn btn-gradient btn-lg px-5 mt-5 shadow">
            🍽️ ดูเมนูเพิ่มเติม
        </a>
    </div>
</section>

<!-- 💬 REVIEWS -->
<section class="py-5 bg-white">
    <div class="container text-center">
        <h3 class="mb-5 fw-bold text-primary-dark">What Says Our Customers</h3>
        <div class="review-slider d-flex justify-content-center flex-wrap gap-3">
            @foreach($reviews as $rev)
                <div class="review-card text-center p-4 bg-light shadow-sm rounded" style="width:250px;">
                    <img src="{{ asset('images/customers/' . ($rev->photo ?? '  ')) }}"
                         class="rounded-circle mb-3 shadow" width="100" height="100" alt="customer">
                    <h5 class="fw-semibold text-primary-dark">{{ $rev->customer_name ?? 'Anonymous' }}</h5>
                    <p class="text-muted small mb-2">"{{ Str::limit($rev->comment ?? '', 100) }}"</p>
                    <div class="text-warning">⭐ Rating: {{ $rev->rating ?? '-' }}/5</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
// ✅ Bootstrap Carousel
document.addEventListener('DOMContentLoaded', function () {
    const carouselEl = document.getElementById('homeCarousel');
    if (carouselEl) {
        new bootstrap.Carousel(carouselEl, {
            interval: 4000,
            ride: 'carousel',
            touch: true,
            pause: 'hover'
        });
    }
});

// ✅ Category filter
$(function() {
    $('.category-btn').on('click', function() {
        let category = $(this).data('category');

        $('.category-btn').removeClass('active').css({'background':'', 'color':'#0d338c'});
        $(this).addClass('active').css({'background':'#0d338c', 'color':'#fff'});

        $('#menu-container').fadeOut(200);
        $('#menu-loading').fadeIn(200);

        $.ajax({
            url: '/filter-menu/' + encodeURIComponent(category),
            method: 'GET',
            success: function(res) {
                $('#menu-loading').fadeOut(200, function() {
                    $('#menu-container').html(res.html).fadeIn(300);
                });
            },
            error: function() {
                $('#menu-loading').fadeOut(200, function() {
                    $('#menu-container').html('<p class="text-danger">❌ ไม่พบเมนูในหมวดนี้</p>').fadeIn(300);
                });
            }
        });
    });
});
</script>
@endpush
@endsection
