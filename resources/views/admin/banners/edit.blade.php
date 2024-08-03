@extends('layouts.app')

@section('content')
    <h1>Sửa Banner Marketing</h1>
    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $banner->title }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="3" required>{{ $banner->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($banner->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="img-thumbnail" style="max-width: 150px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection