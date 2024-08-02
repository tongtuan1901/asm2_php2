@extends('layouts.app')

@section('content')
    <h1>Giỏ hàng</h1>

    @if($cartItems->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->fruit->name }}</td>
                        <td>{{ number_format($item->fruit->price) }} VND</td>
                        <td>
                            <form action="{{ route('cart.update', $item->fruit) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 60px;">
                                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item->quantity * $item->fruit->price) }} VND</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->fruit) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Tổng cộng:</strong></td>
                    <td><strong>{{ number_format($total) }} VND</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <a href="{{ route('order.create') }}" class="btn btn-success">Tiến hành thanh toán</a>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif

    <a href="{{ route('fruits.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
@endsection