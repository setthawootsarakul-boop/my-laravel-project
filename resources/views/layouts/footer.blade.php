<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5>FryGrill</h5>
                <p>ร้านไก่ทอด ไก่ย่าง เฟรนช์ฟราย และสลัด — เปิดทุกวัน 10:00 - 22:00</p>
            </div>

            <div class="col-md-3 mb-3 mb-md-0">
                <h6>Navigation</h6>
                <ul class="list-unstyled">
                    <li><a class="text-white text-decoration-none" href="{{ route('home') }}">Home</a></li>
                    <li><a class="text-white text-decoration-none" href="{{ route('menu') }}">Menu</a></li>
                    <li><a class="text-white text-decoration-none" href="{{ route('about') }}">About</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h6>Contact</h6>
                <p class="mb-1">Tel: 02-123-4567</p>
                <p>Email: info@frygrill.com</p>
            </div>
        </div>

        <div class="text-center mt-3 border-top pt-3">
            &copy; {{ date('Y') }} FryGrill. All rights reserved.
        </div>
    </div>
</footer>
