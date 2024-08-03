@extends('layouts.app')

@section('content')
    <!-- Hiển thị banner marketing -->
    @if($banners->isNotEmpty())
        <div id="bannerCarousel" class="carousel slide mb-4">
            <div class="carousel-inner">
                @foreach($banners as $index => $banner)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="d-flex flex-column align-items-center">
                            @if($banner->image)
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="d-block w-100" style="max-height: 400px; object-fit: cover;">
                            @endif
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $banner->title }}</h5>
                                <p>{{ $banner->content }}</p>
                                @if($banner->link)
                                    <a href="{{ $banner->link }}" class="btn btn-primary" target="_blank">Xem chi tiết</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Phần danh mục -->
    <div class="mb-4">
    <h1 class="mb-4">Danh sách hoa quả</h1>
        <form action="{{ route('fruits.index') }}" method="GET">
            <div class="form-group">
                <label for="category">Chọn danh mục:</label>
                <select id="category" name="category" class="form-select">
                    <option value="">Tất cả danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Lọc</button>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($fruits as $fruit)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($fruit->image)
                        <img src="{{ asset('storage/' . $fruit->image) }}" class="card-img-top" alt="{{ $fruit->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fa-4x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $fruit->name }}</h5>
                        <p class="card-text">Giá: {{ number_format($fruit->price) }} VND</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('fruits.show', $fruit) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-info-circle"></i> Chi tiết
                            </a>
                            <form action="{{ route('cart.add', $fruit) }}" method="POST">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $fruit->stock }}" class="form-control" style="width: 50px;">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-cart-plus"></i> Thêm
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection