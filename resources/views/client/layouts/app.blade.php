<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Pet Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.navbar') {{-- nếu có navbar --}}
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
