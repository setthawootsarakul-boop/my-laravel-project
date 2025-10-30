@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<!-- 🍽️ HEADER -->
<section class="menu-header text-center text-white py-5 mb-5" 
         style="background: linear-gradient(135deg, var(--primary-dark), #0b276d); position: relative;">
    <div class="menu-overlay" 
         style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.25);"></div>
    <div class="container position-relative">
        <h1 class="fw-bold display-5 mb-2">🍴 Our Delicious Menu</h1>
        <p class="lead text-light">เมนูที่เราภูมิใจนำเสนอ — สดใหม่ทุกวัน อร่อยทุกคำ ❤️</p>
    </div>
</section>

<!-- 🍔 MENU GRID -->
<div class="container pb-5">
    <div class="row justify-content-center">
        @foreach($menu as $item)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="menu-card border-0 h-100 shadow-lg rounded-4 overflow-hidden">
                    <div class="menu-card-img position-relative">
                        <!-- ✅ คลิกเปิดรายละเอียด -->
                        <img src="{{ asset('images/' . $item->image) }}" 
                             class="img-fluid w-100 open-detail" 
                             alt="{{ $item->name }}"
                             data-id="{{ $item->id }}"
                             style="object-fit: cover; height: 230px; cursor: pointer;">
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

    <!-- 📜 Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $menu->links() }}
    </div>
</div>

<!-- 🧁 MODAL: รายละเอียดเมนู -->
<div class="modal fade" id="menuDetailModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow-lg"
         style="background: rgba(255,255,255,0.98); backdrop-filter: blur(8px);">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold text-primary-dark">🍽️ รายละเอียดเมนู</h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4 pt-2">
        <div class="row align-items-center">
          <div class="col-md-6 text-center mb-3 mb-md-0">
            <img id="menuImage" src="" alt="" 
                 class="img-fluid rounded-4 shadow-sm border" 
                 style="max-height:320px; object-fit:cover;">
          </div>
          <div class="col-md-6">
            <h4 id="menuName" class="fw-bold text-primary-dark"></h4>
            <p id="menuCategory" class="text-muted small mb-2"></p>

            <!-- 🔖 Tabs -->
            <ul class="nav nav-tabs mt-3" id="menuTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">รายละเอียด</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">ข้อมูลเพิ่มเติม</button>
              </li>
            </ul>

            <!-- 🧾 Tab Content -->
            <div class="tab-content mt-3">
              <div class="tab-pane fade show active" id="desc" role="tabpanel">
                <p id="menuDesc" class="text-secondary mb-3 small"></p>
              </div>
              <div class="tab-pane fade" id="info" role="tabpanel">
                <p class="text-muted small mb-1"><i class="bi bi-clock me-1 text-accent"></i> พร้อมเสิร์ฟภายใน 10-15 นาที</p>
                <p class="text-muted small mb-1"><i class="bi bi-fire me-1 text-accent"></i> ทำสดใหม่ทุกคำ</p>
                <p class="text-muted small"><i class="bi bi-egg-fried me-1 text-accent"></i> วัตถุดิบคุณภาพจากฟาร์มท้องถิ่น</p>
              </div>
            </div>

            <div class="fw-bold text-accent fs-4 mt-3 mb-4">
              <span id="menuPrice"></span> ฿
            </div>
            <button id="addToCartFromModal" class="btn btn-accent rounded-pill px-4 py-2 shadow-sm">
              🛒 เพิ่มในตะกร้า
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    // 🧁 เปิดรายละเอียดเมนู (Popup)
    $('.open-detail').on('click', function () {
        const id = $(this).data('id');

        $.ajax({
            url: `/menu/${id}`,
            type: 'GET',
            success: function (data) {
                $('#menuImage').attr('src', `/images/${data.image}`);
                $('#menuName').text(data.name);
                $('#menuDesc').text(data.description);
                $('#menuPrice').text(Number(data.price).toFixed(2));
                $('#menuCategory').text(data.category ? `หมวดหมู่: ${data.category}` : '');
                $('#addToCartFromModal').data('id', data.id);

                $('#menuDetailModal').modal('show');
            },
            error: function () {
                Swal.fire('Error', 'ไม่สามารถโหลดข้อมูลเมนูได้', 'error');
            }
        });
    });

    // ✅ ป้องกัน event ซ้ำ สำหรับ popup
    $(document).off('click', '#addToCartFromModal').on('click', '#addToCartFromModal', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        addToCart(id, $(this));
    });

    // ✅ ปุ่มสั่งซื้อบนหน้าเมนูหลัก (ไม่ต้องเปิด popup)
    $(document).off('click', '.add-to-cart').on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        addToCart(id, $(this));
    });

    // 🛒 ฟังก์ชันรวม เพิ่มสินค้าในตะกร้า
    function addToCart(id, btn) {
        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: { 
                _token: "{{ csrf_token() }}",
                menu_item_id: id 
            },
            beforeSend: function() {
                btn.prop('disabled', true).html('⏳ กำลังเพิ่ม...');
            },
            success: function (res) {
                btn.prop('disabled', false).html('🛒 สั่งเลย');
                if (res.success) {
                    updateCartCount(res.cart_count);
                    Swal.fire({
                        icon: 'success',
                        title: 'เพิ่มสินค้าแล้ว!',
                        timer: 1200,
                        showConfirmButton: false,
                        background: '#fff',
                        backdrop: 'rgba(13, 51, 140, 0.2)'
                    });
                    $('#menuDetailModal').modal('hide');
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            },
            error: function () {
                btn.prop('disabled', false).html('🛒 สั่งเลย');
                Swal.fire('Error', 'ไม่สามารถเพิ่มสินค้าได้', 'error');
            }
        });
    }
});
</script>
@endpush
