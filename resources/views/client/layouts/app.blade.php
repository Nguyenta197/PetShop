
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Pet Shop - Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (nếu cần) -->
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('client.partials.navbar')

    {{-- Nội dung chính --}}
    <main class="container py-4">
        @include('client.partials.slideshow')

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row">
                <!-- Logo và mô tả -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">🐾 PetShop</h5>
                    <p>Chuyên cung cấp thú cưng và phụ kiện chất lượng cao. Mang đến người bạn đáng yêu cho mọi gia đình!</p>
                </div>

                <!-- Liên kết nhanh -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="text-white text-decoration-none">Trang chủ</a></li>
                        <li><a href="{{ url('/list') }}" class="text-white text-decoration-none">Sản phẩm</a></li>
                        <li><a href="{{ route('client.cart.index') }}" class="text-white text-decoration-none">Giỏ hàng</a></li>
                        <li><a href="{{ route('login') }}" class="text-white text-decoration-none">Đăng nhập</a></li>
                        <li><a href="{{ route('register') }}" class="text-white text-decoration-none">Đăng ký</a></li>
                    </ul>
                </div>

                <!-- Liên hệ -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Liên hệ</h5>
                    <p><i class="bi bi-geo-alt-fill"></i> 123 Đường Thú Cưng, TP HCM</p>
                    <p><i class="bi bi-envelope-fill"></i> support@petshop.vn</p>
                    <p><i class="bi bi-telephone-fill"></i> 0123 456 789</p>
                </div>
            </div>

            <hr class="bg-white">
            <div class="text-center">
                &copy; {{ date('Y') }} PetShop. All rights reserved.
            </div>
        </div>
    </footer>


    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
