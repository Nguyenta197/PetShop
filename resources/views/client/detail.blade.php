@extends('client.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <h4 class="text-success mb-3">{{ number_format($product->price) }} VND</h4>
            <p>{{ $product->description }}</p>

            <button class="btn btn-success mt-3">Thêm vào giỏ hàng</button>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    @if ($relatedProducts->count())
    <h4 class="mt-5 mb-3">Sản phẩm liên quan</h4>
    <div class="row">
        @foreach ($relatedProducts as $related)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $related->image ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $related->name }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ $related->name }}</h6>
                        <p class="card-text">Giá: {{ number_format($related->price) }} VND</p>
                        <a href="{{ route('client.products.detail', $related->id) }}" class="btn btn-sm btn-outline-secondary">Xem</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif

</div>

@endsection
