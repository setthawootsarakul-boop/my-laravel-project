@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<!-- 🌅 HERO HEADER -->
<section class="hero-header text-center text-white d-flex align-items-center justify-content-center">
    <div class="overlay"></div>
    <div class="content">
        <h1 class="display-3 fw-bold mb-3">FryGrill — อร่อยทุกคำ</h1>
        <p class="lead mb-4">ไก่ทอดกรอบ ไก่ย่างหอม เฟรนช์ฟรายส์สไตล์โฮมเมด</p>
        <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-5">ดูเมนูทั้งหมด</a>
    </div>
</section>

<!-- 🎠 CAROUSEL -->
<section class="py-5 bg-light">
    <div class="container">
        <div id="homeCarousel" class="carousel slide rounded shadow" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#homeCarousel" data-slide-to="1"></li>
                <li data-target="#homeCarousel" data-slide-to="2"></li>
            </ol>
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
            <a class="carousel-control-prev" href="#homeCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#homeCarousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</section>

<!-- 🍗 OUR MENU SPECIALS -->
<section class="popular-section text-center">
    <div class="container">
        <h3 class="fw-bold text-primary-dark mb-4">🍗 Our Menu Specials</h3>
        <div class="popular-row">
            @foreach($popular->take(2) as $item)
                <div class="menu-box">
                    <div class="menu-img">
                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}">
                        <span class="discount-badge">-15%</span>
                    </div>
                    <div class="menu-content">
                        <h5 class="text-primary-dark">{{ $item->name }}</h5>
                        <p>{{ Str::limit($item->description, 60) }}</p>
                        <div class="price">{{ number_format($item->price, 2) }} ฿</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 🍽️ OUR MENU -->
<section class="py-5" style="background: var(--light-bg);">
    <div class="container text-center">
        <h3 class="fw-bold mb-3 text-primary-dark">Our Delicious Menu</h3>
        <p class="text-muted mb-5">เมนูทั้งหมดที่เราภูมิใจนำเสนอ — สดใหม่ทุกวัน อร่อยทุกคำ ❤️</p>

        <div class="d-flex flex-wrap justify-content-center gap-4">
            @foreach($menu as $item)
                <div class="card menu-card border-0 shadow-sm" style="width: 250px;">
                    <img src="{{ asset('images/' . $item->image) }}" 
                         class="card-img-top" 
                         alt="{{ $item->name }}" 
                         style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title text-primary-dark">{{ $item->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($item->description, 60) }}</p>
                        <strong class="text-accent">{{ number_format($item->price, 2) }} ฿</strong>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('menu') }}" class="btn btn-accent btn-lg px-5 mt-5">ดูเพิ่มเติม</a>
    </div>
</section>

<!-- 💬 REVIEWS -->
<section class="py-5 bg-white">
    <div class="container text-center">
        <h3 class="mb-5 fw-bold text-primary-dark">What Says Our Customers</h3>
        <div class="review-slider">
            @foreach($reviews as $rev)
                <div class="review-card text-center p-4 bg-light shadow-sm rounded mx-2">
                    <img src="{{ asset('images/customers/' . ($rev->photo ?? 'default.jpg')) }}"
                         class="rounded-circle mb-3 shadow" width="100" height="100">
                    <h5 class="fw-semibold text-primary-dark">{{ $rev->customer_name ?? 'Anonymous' }}</h5>
                    <p class="text-muted small mb-2">"{{ Str::limit($rev->comment ?? '', 100) }}"</p>
                    <div class="text-warning">⭐ Rating: {{ $rev->rating ?? '-' }}/5</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection