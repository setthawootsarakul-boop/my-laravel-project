@extends('layouts.app')

@section('content')
<div class="about-section py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <!-- ข้อความ -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-3 text-primary-dark">About FryGrill</h2>
                <p class="lead text-muted">
                    ร้านอาหารสไตล์ไก่ทอดและไก่ย่าง ที่ผสมผสานรสชาติความกรอบและหอมอร่อย
                    ใช้วัตถุดิบสดใหม่ทุกวัน และคัดสรรเมนูเพื่อสุขภาพอย่างสลัดและของทานเล่นสุดพิเศษ
                </p>
                <p class="text-muted">
                    เราเชื่อว่า “อาหารดี” คือการส่งต่อความสุขจากครัวสู่ลูกค้าทุกคน  
                    มาร่วมสัมผัสรสชาติที่ทั้งอร่อยและอบอุ่นไปกับเราได้ที่ <strong>FryGrill</strong> ทุกสาขา ❤️
                </p>
            </div>

            <!-- รูปภาพ -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/about.jpg') }}" 
                     class="img-fluid rounded-4 shadow-lg about-img"
                     alt="About FryGrill">
            </div>
        </div>
    </div>
</div>
@endsection
