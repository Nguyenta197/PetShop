@extends('client.layouts.app')
@if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@section('content')
<div class="container">
    <h2 class="my-4">Danh sách thú cưng</h2>

    {{-- Form tìm kiếm và lọc --}}
    <form method="GET" action="{{ route('client.products.list') }}" class="row mb-4">
        <div class="col-md-4 mb-2">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên"
                   value="{{ request('keyword') }}">
        </div>
        <div class="col-md-4 mb-2">
            <select name="price_filter" class="form-select">
                <option value="">-- Lọc theo giá --</option>
                <option value="under_1m" {{ request('price_filter') == 'under_1m' ? 'selected' : '' }}>Dưới 1 triệu</option>
                <option value="1m_3m" {{ request('price_filter') == '1m_3m' ? 'selected' : '' }}>Từ 1 - 3 triệu</option>
                <option value="over_3m" {{ request('price_filter') == 'over_3m' ? 'selected' : '' }}>Trên 3 triệu</option>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <button type="submit" class="btn btn-primary w-100">Tìm kiếm / Lọc</button>
        </div>
    </form>

    <!-- Danh sách sản phẩm -->
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->image }}" width="70px">
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
