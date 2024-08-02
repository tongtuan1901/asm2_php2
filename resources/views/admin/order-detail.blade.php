@extends('layouts.admin')

@section('content')
    <h1>Chi tiết đơn hàng #{{ $order->id }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Thông tin khách hàng</h5>
            <p><strong>Tên:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
        </div>
    </div>

    <h2>Các sản phẩm trong đơn hàng</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->fruit->name }}</td>
                    <td>{{ number_format($item->price) }} VND</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }} VND</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Tổng cộng:</strong></td>
                <td><strong>{{ number_format($order->total) }} VND</strong></td>
            </tr>
        </tfoot>
    </table>

    <p><strong>Trạng thái đơn hàng:</strong> {{ $order->status }}</p>
    <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <form action="{{ route('admin.orders.delete', $order) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa đơn hàng</button>
    </form>

    <a href="{{ route('admin.orders') }}" class="btn btn-primary mt-3">Quay lại danh sách đơn hàng</a>
@endsection