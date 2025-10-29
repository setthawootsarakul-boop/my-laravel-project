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
                    </tr>
                </thead>
                <tbody class="bg-white" id="cart-body">
                    @foreach($cartItems as $item)
                        <tr data-id="{{ $item->id }}">
                            <td>
                                <img src="{{ asset('images/' . $item->menuItem->image) }}"
                                     class="rounded-3 shadow-sm"
                                     width="80" height="60"
                                     style="object-fit:cover;">
                            </td>
                            <td class="fw-semibold">{{ $item->menuItem->name }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm decrease-qty rounded-circle px-2"
                                            data-id="{{ $item->id }}">➖</button>
                                    <span class="mx-2 quantity fw-semibold">{{ $item->quantity }}</span>
                                    <button class="btn btn-outline-secondary btn-sm increase-qty rounded-circle px-2"
                                            data-id="{{ $item->id }}">➕</button>
                                </div>
                            </td>
                            <td class="text-end">{{ number_format($item->menuItem->price, 2) }} ฿</td>
                            <td class="text-end text-accent fw-bold total-item">
                                {{ number_format($item->menuItem->price * $item->quantity, 2) }} ฿
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
            <h5 class="text-muted">
                ยอดรวมสินค้า:
                <span id="subtotal" class="fw-semibold text-dark">
                    {{ number_format($total, 2) }} ฿
                </span>
            </h5>
            <h5 class="text-muted">
                ภาษีมูลค่าเพิ่ม (VAT 7%):
                <span id="vat" class="fw-semibold text-dark">
                    {{ number_format($vat, 2) }} ฿
                </span>
            </h5>
            <h4 class="mt-2">
                💰 ยอดชำระทั้งหมด:
                <span id="grandtotal" class="text-accent fw-bold">
                    {{ number_format($grandTotal, 2) }} ฿
                </span>
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
$(function() {

    // ลบ event เก่าทิ้งก่อน กันซ้ำ
    $(document).off('click', '.increase-qty');
    $(document).off('click', '.decrease-qty');

    // ➕ เพิ่มสินค้า
    $(document).on('click', '.increase-qty', function() {
        const id = $(this).data('id');
        updateQuantity(id, 'increase');
    });

    // ➖ ลดสินค้า
    $(document).on('click', '.decrease-qty', function() {
        const id = $(this).data('id');
        const row = $(this).closest('tr');
        const qty = parseInt(row.find('.quantity').text());

        if (qty === 1) {
            Swal.fire({
                title: 'ลบสินค้า?',
                text: 'คุณต้องการลบสินค้านี้ออกจากตะกร้าใช่ไหม?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ลบเลย',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeItem(id);
                }
            });
        } else {
            updateQuantity(id, 'decrease');
        }
    });

    // ✅ ฟังก์ชันอัปเดตจำนวน
    function updateQuantity(id, action) {
        $.ajax({
            url: "{{ url('/cart/update') }}/" + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                action: action
            },
            success: function(res) {
                if (res.success) {
                    location.reload();
                } else {
                    Swal.fire('ผิดพลาด', res.message || 'ไม่สามารถอัปเดตจำนวนได้', 'error');
                }
            },
            error: function() {
                Swal.fire('ผิดพลาด', 'เชื่อมต่อเซิร์ฟเวอร์ไม่สำเร็จ', 'error');
            }
        });
    }

    // ✅ ฟังก์ชันลบสินค้า
    function removeItem(id) {
        $.ajax({
            url: "{{ url('/cart/remove') }}/" + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.success) {
                    Swal.fire('สำเร็จ', 'ลบสินค้าออกจากตะกร้าแล้ว', 'success');
                    setTimeout(() => location.reload(), 700);
                } else {
                    Swal.fire('ผิดพลาด', 'ไม่สามารถลบสินค้าได้', 'error');
                }
            },
            error: function() {
                Swal.fire('ผิดพลาด', 'เชื่อมต่อเซิร์ฟเวอร์ไม่สำเร็จ', 'error');
            }
        });
    }

});
</script>
@endpush
