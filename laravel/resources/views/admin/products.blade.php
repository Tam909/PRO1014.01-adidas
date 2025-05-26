@extends('admin.layout')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <p>Danh sách sản phẩm sẽ hiển thị tại đây.</p>

    <h1>Danh sách sản phẩm</h1>
    <a href="{{ route('products.create') }}">+ Thêm mới</a>
    
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    
    <table border="1">
        <tr>
            <th>Tên</th><th>Giá</th><th>Ảnh</th><th>Hành động</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" width="100">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">Sửa</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Xoá thật hả?')">Xoá</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    
   

    
@endsection
