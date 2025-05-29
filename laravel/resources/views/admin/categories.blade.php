@extends('admin.layout')

@section('title', 'Quản lý danh mục sản phẩm')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Danh sách danh mục</h2>
     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-3">+ Thêm Danh Mục</a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if ($category->status_categories === 0)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-secondary">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-sm btn-warning">Sửa</a>

                        <form action="{{ route('admin.category.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Xóa danh mục này?')" class="btn btn-sm btn-danger">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Chưa có danh mục nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
