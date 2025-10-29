@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-primary-dark">🛒 ตะกร้าของคุณ</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <p class="text-muted">ตะกร้าของคุณยังว่างเปล่า 😢</p>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>สินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>รวม</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php
                            $subtotal = $item->menuItem->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $item->menuItem->image) }}" width="70" class="rounded me-2">
                                {{ $item->menuItem->name }}
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
                                    @csrf
                                    <input type="number" name="quantity" min="1" max="{{ $item->menuItem->inventory->quantity ?? 1 }}"
                                           value="{{ $item->quantity }}" class="form-control d-inline w-50 text-center">
                                    <button type="submit" class="btn btn-sm btn-outline-primary mt-2">อัปเดต</button>
                                </form>
                            </td>
                            <td>{{ number_format($item->menuItem->price, 2) }} ฿</td>
                            <td>{{ number_format($subtotal, 2) }} ฿</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="fw-bold">
                    <tr>
                        <td colspan="3" class="text-end">ยอดรวมทั้งหมด:</td>
                        <td>{{ number_format($total, 2) }} ฿</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif
</div>
@endsection
