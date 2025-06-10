@extends('admin.layout')

@section('title', 'Quản lý danh mục sản phẩm')

@section('content')
<div class="container">
    <h2>Danh sách sản phẩm</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Danh mục</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->category->name ?? 'Không có' }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ number_format($p->price, 0, ',', '.') }} đ</td>
                <td>
                    @if($p->img)
                        <img src="{{ asset('storage/' . $p->img) }}" width="60">
                    @endif
                </td>
                <td>{{ $p->status == 0 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                <td>
                    <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('products.destroy', $p) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Xoá thật không?')" class="btn btn-sm btn-danger">Xoá</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
