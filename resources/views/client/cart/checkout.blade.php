@extends('client.layouts.app')

@section('content')
@extends('client.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Thông tin thanh toán</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('client.cart.checkout.process') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Form thông tin -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên</label>
                    <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}" required>
                    @error('fullname') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="col-md-6">
                <h5>Đơn hàng của bạn</h5>
                <ul class="list-group mb-3">
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                        @php $itemTotal = $item['price'] * $item['quantity']; $total += $itemTotal; @endphp
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item['name'] }} x {{ $item['quantity'] }}</h6>
                            </div>
                            <span class="text-muted">{{ number_format($itemTotal) }} VND</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Tổng:</strong>
                        <strong>{{ number_format($total) }} VND</strong>
                    </li>
                </ul>

                <button type="submit" class="btn btn-success w-100">Xác nhận đặt hàng</button>
            </div>
        </div>
    </form>
</div>
@endsection
