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
                <div class="menu-card border-0 h-100">
                    <div class="menu-card-img">
                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}">
                        <span class="menu-card-category">{{ $item->category }}</span>
                    </div>
                    <div class="menu-card-body text-center">
                        <h5 class="fw-bold text-primary-dark">{{ $item->name }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($item->description, 80) }}</p>
                        <div class="fw-bold text-accent fs-5 mb-3">{{ number_format($item->price, 2) }} ฿</div>
                        <a href="#" class="btn btn-accent rounded-pill px-4">สั่งเลย</a>
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
