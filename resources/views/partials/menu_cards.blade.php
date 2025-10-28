@php use Illuminate\Support\Str; @endphp


@foreach($menu as $item)
    <div class="col-md-3 col-sm-6">
        <div class="menu-card p-3">
            <div class="menu-img-wrapper">
                <img src="{{ asset('images/'.$item->image)}}" class="img-fluid rounded" alt="{{ $item->name }}">
                <div class="menu-category">{{ $item->category }}</div>
            </div>
            <h5 class="mt-3">{{ $item->name }}</h5>
            <p class="text-muted small">{{ $item->description }}</p>
            <strong>${{ $item->price }}</strong>
        </div>
    </div>
@endforeach


@if($menu->isEmpty())
    <p class="text-muted">ไม่พบเมนูในหมวดนี้ 😢</p>
@endif
