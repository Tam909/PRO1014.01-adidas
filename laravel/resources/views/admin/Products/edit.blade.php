@extends('admin.layout')

@section('title', 'Quản lý danh mục sản phẩm')

@section('content')
    <div class="container">
        <h2>Sửa sản phẩm</h2>
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            {{-- <pre>{{ dd($product) }}</pre> --}}
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Danh mục</label>
                <select name="id_categories" class="form-control">
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}" {{ $product->id_categories == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Tên sản phẩm</label>
                <input name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label>Giá</label>
                <input name="price" class="form-control" type="number" value="{{ $product->price }}" required>
            </div>

            <div class="mb-3">
                <label>Hình ảnh</label>
                <input name="img" type="file" class="form-control">
                @if ($product->img)
                    <img src="{{ asset('storage/' . $product->img) }}" width="100" class="mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Chọn màu</label>
                <div class="form-check">
                    @foreach (\App\Models\Color::all() as $color)
                        <input type="checkbox" name="colors[]" value="{{ $color->id }}" class="form-check-input"
                            id="color_{{ $color->id }}"
                            {{ $product->variants->pluck('id_color')->contains($color->id) ? 'checked' : '' }}>
                        <label for="color_{{ $color->id }}" class="form-check-label">{{ $color->name }}</label><br>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label>Chọn size</label>
                <div class="form-check">
                    @foreach (\App\Models\Size::all() as $size)
                        <input type="checkbox" name="sizes[]" value="{{ $size->id }}" class="form-check-input"
                            id="size_{{ $size->id }}"
                            {{ $product->variants->pluck('id_size')->contains($size->id) ? 'checked' : '' }}>
                        <label for="size_{{ $size->id }}" class="form-check-label">{{ $size->name }}</label><br>
                    @endforeach
                </div>
            </div>


            <button class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
