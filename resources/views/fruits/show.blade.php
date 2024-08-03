@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                @if($fruit->image)
                    <img src="{{ asset('storage/' . $fruit->image) }}" class="img-fluid rounded-start" alt="{{ $fruit->name }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 100%;">
                        <i class="fas fa-image fa-4x text-muted"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ $fruit->name }}</h1>
                    <p class="card-text"><strong>Mô tả:</strong> {{ $fruit->description }}</p>
                    <p class="card-text"><strong>Giá:</strong> {{ number_format($fruit->price) }} VND</p>
                    <p class="card-text"><strong>Số lượng còn:</strong> {{ $fruit->stock }}</p>
                     <form action="{{ route('cart.add', $fruit) }}" method="POST" class="mt-3">
    @csrf
    <div class="input-group mb-3" style="max-width: 150px;">
        <input type="number" name="quantity" class="form-control" value="1" min="1">
        <button class="btn btn-primary" type="submit">Thêm vào giỏ hàng</button>
    </div>
</form>
             <a href="{{ route('fruits.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại danh sách
    </a>       
                </div>
            </div>
        </div>
    </div>
   
    
@endsection