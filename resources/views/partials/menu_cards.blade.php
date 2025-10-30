@php use Illuminate\Support\Str; @endphp


@foreach($menu as $item)
    <div class="menu-card p-3 text-center shadow-sm">
        <div class="menu-card-img position-relative">
            <img src="{{ asset('images/'.$item->image) }}" class="img-fluid rounded" alt="{{ $item->name }}">
            <span class="menu-card-category">{{ $item->category }}</span>
        </div>
        <h5 class="mt-3 fw-bold text-primary-dark">{{ $item->name }}</h5>
        <p class="text-muted small">{{ Str::limit($item->description, 60) }}</p>
        <div class="fw-bold text-accent">{{ number_format($item->price, 2) }} ฿</div>
    </div>
@endforeach


@if($menu->isEmpty())
    <p class="text-muted">ไม่พบเมนูในหมวดนี้ 😢</p>
@endif
