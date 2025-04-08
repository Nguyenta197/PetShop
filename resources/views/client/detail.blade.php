@extends('layouts.client')

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
</div>
@endsection
