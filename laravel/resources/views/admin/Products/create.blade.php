@extends('admin.layout')

@section('title', 'Quản lý danh mục sản phẩm')

@section('content')
<div class="container">
    <h2>Thêm sản phẩm</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Danh mục</label>
            <select name="id_categories" class="form-control">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input name="price" class="form-control" type="number" required>
        </div>

        <div class="mb-3">
            <label>Hình ảnh</label>
            <input name="img" type="file" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0">Hoạt động</option>
                <option value="1">Không hoạt động</option>
            </select>
        </div>

       <div class="mb-3">
    <label>Chọn các màu:</label>
    <div class="row">
        @foreach($colors as $color)
            <div class="col-md-2">
                <input type="checkbox" name="colors[]" value="{{ $color->id }}"> {{ $color->name }}
            </div>
        @endforeach
    </div>
</div>

<div class="mb-3">
    <label>Chọn các size:</label>
    <div class="row" id="size-options">
        @foreach($sizes as $size)
            <div class="col-md-2">
                <input type="checkbox" name="sizes[]" value="{{ $size->id }}"> {{ $size->name }}
            </div>
        @endforeach
    </div>
</div>



        <button class="btn btn-success">Thêm</button>
    </form>
</div>
@endsection
