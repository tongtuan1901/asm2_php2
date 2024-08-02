@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ isset($fruit) ? 'Chỉnh sửa: ' . $fruit->name : 'Thêm hoa quả mới' }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ isset($fruit) ? route('fruits.update', $fruit) : route('fruits.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($fruit))
                    @method('PUT')
                @endif
                
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $fruit->name ?? old('name') }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $fruit->description ?? old('description') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <div class="input-group">
                        <span class="input-group-text">VND</span>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $fruit->price ?? old('price') }}" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="stock" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $fruit->stock ?? old('stock') }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (isset($fruit) && $fruit->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if (isset($fruit) && $fruit->image)
                        <img src="{{ asset('storage/' . $fruit->image) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($fruit) ? 'Cập nhật' : 'Thêm' }}
                </button>
                
                <a href="{{ route('fruits.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Hủy
                </a>
            </form>
        </div>
    </div>
@endsection