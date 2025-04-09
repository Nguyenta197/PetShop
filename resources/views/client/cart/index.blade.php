@extends('client.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Giỏ hàng của bạn</h2>
    @if(session('cart') && count(session('cart')))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr>
                        <td><img src="{{ asset('storage/' . $item['image']) }}" width="60"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control w-50">
                                <button class="btn btn-sm btn-primary ms-2">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['price']) }} VND</td>
                        <td>{{ number_format($item['price'] * $item['quantity']) }} VND</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4"><strong>Tổng:</strong></td>
                    <td colspan="2"><strong>{{ number_format($total) }} VND</strong></td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Giỏ hàng trống.</p>
    @endif
</div>
@endsection
