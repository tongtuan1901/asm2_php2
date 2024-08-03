    @extends('admin.layout')

    @section('content')
        <h1>Trang chủ admin</h1>
        <h2>Fruit List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fruits as $fruit)
                    <tr>
                        <td>{{ $fruit->id }}</td>
                        <td>{{ $fruit->name }}</td>
                        <td>{{ number_format($fruit->price) }} VND</td>
                        <td>{{ $fruit->stock }}</td>
                        <td>{{ $fruit->category ? $fruit->category->name : 'N/A' }}</td>
                        <td>
                            @if($fruit->image)
                                <img src="{{ asset('storage/' . $fruit->image) }}" alt="{{ $fruit->name }}" class="img-thumbnail" style="max-width: 100px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('fruits.edit', $fruit) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('fruits.destroy', $fruit) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa nhé?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('fruits.create') }}" class="btn btn-success">Thêm Sản Phẩm</a>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Quản lý danh mục sản phẩm</a>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-primary">Quản lý banner Markerting</a>
        
    @endsection