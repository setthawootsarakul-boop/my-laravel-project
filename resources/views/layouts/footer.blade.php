<footer class="footer text-white mt-5">
    <div class="container py-5">
        <div class="row">
            <!-- 🔸 Brand -->
            <div class="col-md-5 mb-4 mb-md-0">
                <h4 class="fw-bold text-accent">FryGrill</h4>
                <p class="small mb-3">
                    ร้านไก่ทอด ไก่ย่าง เฟรนช์ฟราย และสลัด — เปิดทุกวัน 10:00 - 22:00<br>
                    วัตถุดิบสดใหม่ทุกวันเพื่อคุณ 💛
                </p>
                <div class="social-icons d-flex gap-3">
                    <!-- ใช้ Bootstrap Icons -->
                    <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-line"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-twitter-x"></i></a>
                    <a href="mailto:info@frygrill.com" class="text-white fs-4"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            <!-- 🔹 Navigation -->
            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="text-uppercase fw-bold mb-3">Navigation</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                    <li><a href="{{ route('menu') }}" class="footer-link">Menu</a></li>
                    <li><a href="{{ route('about') }}" class="footer-link">About</a></li>
                    <li><a href="{{ route('reviews') }}" class="footer-link">Reviews</a></li>
                </ul>
            </div>

            <!-- 🔸 Contact -->
            <div class="col-md-3">
                <h6 class="text-uppercase fw-bold mb-3">Contact</h6>
                <p class="mb-1">📞 02-123-4567</p>
                <p>✉️ info@frygrill.com</p>
            </div>
        </div>

        <hr class="border-light my-4">

        <div class="text-center small">
            &copy; {{ date('Y') }} <span class="text-accent fw-bold">FryGrill</span>. All rights reserved.
        </div>
    </div>
</footer>
