@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-primary-dark text-center">
        🛒 ตะกร้าของคุณ
    </h2>

    @if($cartItems->isEmpty())
        <div class="text-center py-5">
            <img src="{{ asset('images/empty-cart.png') }}" alt="Empty Cart" class="mb-3" style="max-width:180px;">
            <p class="text-muted fs-5">ยังไม่มีสินค้าในตะกร้า 😋</p>
            <a href="{{ route('menu') }}" class="btn btn-accent rounded-pill mt-3 px-4">
                ไปเลือกเมนูอร่อยๆ 🍔
            </a>
        </div>
    @else
        <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
            <table class="table align-middle mb-0">
                <thead style="background-color: var(--primary-dark); color: #fff;">
                    <tr>
                        <th>ภาพ</th>
                        <th>ชื่อเมนู</th>
                        <th class="text-center">จำนวน</th>
                        <th class="text-end">ราคา</th>
                        <th class="text-end">รวม</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $item->menuItem->image) }}" 
                                     class="rounded-3 shadow-sm" width="80" height="60" 
                                     style="object-fit:cover;">
                            </td>
                            <td class="fw-semibold">{{ $item->menuItem->name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">{{ number_format($item->menuItem->price, 2) }} ฿</td>
                            <td class="text-end text-accent fw-bold">
                                {{ number_format($item->menuItem->price * $item->quantity, 2) }} ฿
                            </td>
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm remove-item rounded-pill px-3"
                                        data-id="{{ $item->id }}">
                                    <i class="bi bi-trash me-1"></i> ลบ
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @php
            $vat = $total * 0.07;
            $grandTotal = $total + $vat;
        @endphp

        <div class="text-end mt-4">
            <h5 class="text-muted">ยอดรวมสินค้า: 
                <span class="fw-semibold text-dark">{{ number_format($total, 2) }} ฿</span>
            </h5>
            <h5 class="text-muted">ภาษีมูลค่าเพิ่ม (VAT 7%): 
                <span class="fw-semibold text-dark">{{ number_format($vat, 2) }} ฿</span>
            </h5>
            <h4 class="mt-2">💰 ยอดชำระทั้งหมด: 
                <span class="text-accent fw-bold">{{ number_format($grandTotal, 2) }} ฿</span>
            </h4>

            <div class="mt-4">
                <a href="{{ route('menu') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">
                    ➕ เพิ่มเมนู
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2">
                    ❌ ยกเลิก
                </a>
                <button class="btn btn-accent rounded-pill px-4">
                    ✅ ดำเนินการสั่งซื้อ
                </button>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.remove-item', function(e) {
    e.preventDefault();
    const id = $(this).data('id');

    Swal.fire({
        title: 'ลบสินค้า?',
        text: 'คุณแน่ใจหรือไม่ว่าต้องการลบสินค้านี้ออกจากตะกร้า?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'ลบเลย',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ url('cart/remove') }}/" + id;
        }
    });
});
</script>
@endpush
