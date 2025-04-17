@extends('client.layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center">🛒 Giỏ hàng của bạn</h2>

    @if(session('cart') && count(session('cart')))
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item['image']) }}" width="70" class="rounded shadow-sm">
                            </td>
                            <td class="fw-semibold">{{ $item['name'] }}</td>
                            <td>
                                <form action="{{ route('client.cart.update', $id) }}" method="POST" class="d-flex justify-content-center">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control w-50 text-center">
                                    <button class="btn btn-sm btn-outline-primary ms-2">⟳</button>
                                </form>
                            </td>
                            <td>{{ number_format($item['price']) }}₫</td>
                            <td>{{ number_format($item['price'] * $item['quantity']) }}₫</td>
                            <td>
                                <form action="{{ route('client.cart.remove', $id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm">🗑 Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-light">
                        <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                        <td colspan="2" class="fw-bold text-danger fs-5">{{ number_format($total) }}₫</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <a href="{{ route('home') }}" class="btn btn-secondary me-2">← Tiếp tục mua hàng</a>
            <a href="#" class="btn btn-success">💳 Thanh toán</a>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Giỏ hàng của bạn đang trống 😢 <br>
            <a href="{{ route('home') }}" class="btn btn-sm btn-primary mt-3">Quay lại mua hàng</a>
        </div>
    @endif
</div>
@endsection
