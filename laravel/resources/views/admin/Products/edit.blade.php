@extends('admin.layout')

@section('title', 'Cập nhật sản phẩm')

@section('content')
<div class="container">
    <h2>Cập nhật sản phẩm</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Danh mục -->
        <div class="mb-3">
            <label>Danh mục</label>
            <select name="id_categories" class="form-control">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ $product->id_categories == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tên, giá, ảnh, mô tả -->
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
            @if($product->img)
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

        <!-- Màu -->
        <div class="mb-3">
            <label>Chọn các màu:</label>
            <div class="row">
                @foreach($colors as $color)
                    <div class="col-md-2">
                        <input type="checkbox" name="colors[]" class="color-checkbox" value="{{ $color->id }}" data-name="{{ $color->name }}"
                            {{ $product->variants->pluck('id_color')->contains($color->id) ? 'checked' : '' }}>
                        {{ $color->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Size -->
        <div class="mb-3">
            <label>Chọn các size:</label>
            <div class="row">
                @foreach($sizes as $size)
                    <div class="col-md-2">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" value="{{ $size->id }}" data-name="{{ $size->name }}"
                            {{ $product->variants->pluck('id_size')->contains($size->id) ? 'checked' : '' }}>
                        {{ $size->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Biến thể -->
        <div class="mb-3">
            <label>Các biến thể đã chọn:</label>
            <table class="table table-bordered" id="variant-table">
                <thead>
                    <tr>
                        <th>Màu</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->variants as $variant)
                        <tr id="variant-{{ $variant->id_color }}-{{ $variant->id_size }}">
                            <td>
                                {{ $variant->color->name }}
                                <input type="hidden" name="variants[{{ $variant->id_color }}][{{ $variant->id_size }}][color_id]" value="{{ $variant->id_color }}">
                            </td>
                            <td>
                                {{ $variant->size->name }}
                                <input type="hidden" name="variants[{{ $variant->id_color }}][{{ $variant->id_size }}][size_id]" value="{{ $variant->id_size }}">
                            </td>
                            <td>
                                <input type="number" name="variants[{{ $variant->id_color }}][{{ $variant->id_size }}][quantity]" class="form-control" value="{{ $variant->quantity }}">
                            </td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-variant" data-color="{{ $variant->id_color }}" data-size="{{ $variant->id_size }}">X</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const colorCheckboxes = document.querySelectorAll('.color-checkbox');
    const sizeCheckboxes = document.querySelectorAll('.size-checkbox');
    const variantTable = document.querySelector('#variant-table tbody');

    function updateVariantTable() {
        colorCheckboxes.forEach(color => {
            if (color.checked) {
                sizeCheckboxes.forEach(size => {
                    if (size.checked) {
                        const colorId = color.value;
                        const sizeId = size.value;
                        const colorName = color.dataset.name;
                        const sizeName = size.dataset.name;
                        const rowId = `variant-${colorId}-${sizeId}`;

                        if (!document.getElementById(rowId)) {
                            const row = document.createElement('tr');
                            row.id = rowId;
                            row.innerHTML = `
                                <td>${colorName}
                                    <input type="hidden" name="variants[${colorId}][${sizeId}][color_id]" value="${colorId}">
                                </td>
                                <td>${sizeName}
                                    <input type="hidden" name="variants[${colorId}][${sizeId}][size_id]" value="${sizeId}">
                                </td>
                                <td>
                                    <input type="number" name="variants[${colorId}][${sizeId}][quantity]" class="form-control" value="0" min="0">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-variant" data-color="${colorId}" data-size="${sizeId}">X</button>
                                </td>
                            `;
                            variantTable.appendChild(row);
                        }
                    }
                });
            }
        });
    }

    // Lắng nghe checkbox
    colorCheckboxes.forEach(cb => cb.addEventListener('change', updateVariantTable));
    sizeCheckboxes.forEach(cb => cb.addEventListener('change', updateVariantTable));

    // Xóa dòng
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-variant')) {
            const rowId = `variant-${e.target.dataset.color}-${e.target.dataset.size}`;
            const row = document.getElementById(rowId);
            if (row) row.remove();
        }
    });
});
</script>
@endpush
