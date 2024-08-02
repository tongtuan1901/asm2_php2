@extends('layouts.app')

@section('content')
    <h1>Thanh toán</h1>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>

        <h2>Đơn hàng của bạn</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->fruit->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->fruit->price) }} VND</td>
                        <td>{{ number_format($item->quantity * $item->fruit->price) }} VND</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Tổng cộng:</strong></td>
                    <td><strong>{{ number_format($total) }} VND</strong></td>
                </tr>
            </tfoot>
        </table>

        <button type="submit" class="btn btn-success">Đặt hàng (COD)</button>
    </form>
@endsection