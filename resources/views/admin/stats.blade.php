@extends('admin.layout')

@section('content')
    <h1>Số liệu thống kê</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng số trái cây đã mua</h5>
                    <p class="card-text">{{ $totalFruits }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Số lượng</h5>
                    <p class="card-text">{{ $totalStock }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Average Price</h5>
                    <p class="card-text">{{ number_format($averagePrice, 2) }} VND</p>
                </div>
            </div>
        </div>
    </div>
@endsection