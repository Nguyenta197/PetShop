@extends('layouts.app') {{-- hoặc layout bạn đang dùng --}}

@section('content')
<div class="container">
    <h2 class="my-4">Danh sách thú cưng</h2>

    <!-- Tìm kiếm & Lọc -->
    <form action="{{ route('client.products.list') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên..." value="{{ request('keyword') }}">
        </div>
        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="">Tất cả danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit">Lọc</button>
        </div>
    </form>

    <!-- Danh sách sản phẩm -->
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Giá: {{ number_format($product->price) }} VND</p>
                        <a href="{{ route('client.products.detail', $product->id) }}" class="btn btn-outline-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Không có sản phẩm nào phù hợp.</p>
        @endforelse
    </div>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
