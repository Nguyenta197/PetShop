<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ | Pet Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">🐾 Pet Shop</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/" class="nav-link">Trang Chủ</a></li>
                <li class="nav-item"><a href="/list" class="nav-link">Sản Phẩm</a></li>
                @auth
                    <li class="nav-item"><form method="POST" action="{{ route('logout') }}">@csrf <button class="btn btn-link nav-link" type="submit">Đăng xuất</button></form></li>
                @else
                    <li class="nav-item"><a href="/login" class="nav-link">Đăng nhập</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Banner -->
<div class="container mt-4">
    <div class="text-center">
        <h1 class="display-4">Chào mừng đến với Pet Shop!</h1>
        <p class="lead">Nơi bạn tìm thấy người bạn bốn chân tuyệt vời nhất 🐶🐱</p>
        <a href="/list" class="btn btn-primary btn-lg">Khám phá thú cưng</a>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center p-3 mt-5">
    &copy; {{ date('Y') }} Pet Shop. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
