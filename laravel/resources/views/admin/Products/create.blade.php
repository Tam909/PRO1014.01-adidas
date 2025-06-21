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
<!-- Màu sắc -->
<div class="mb-3">
    <label>Chọn các màu:</label>
    <div class="row">
        @foreach($colors as $color)
            <div class="col-md-2">
                <input type="checkbox" name="colors[]" class="color-checkbox" value="{{ $color->id }}" data-name="{{ $color->name }}"> {{ $color->name }}
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
                <input type="checkbox" name="sizes[]" class="size-checkbox" value="{{ $size->id }}" data-name="{{ $size->name }}"> {{ $size->name }}
            </div>
        @endforeach
    </div>
</div>
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
           @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const colorCheckboxes = document.querySelectorAll('.color-checkbox');
    const sizeCheckboxes = document.querySelectorAll('.size-checkbox');
    const variantTable = document.querySelector('#variant-table tbody');

    function updateVariantTable() {
        variantTable.innerHTML = '';

        colorCheckboxes.forEach(color => {
            if (color.checked) {
                sizeCheckboxes.forEach(size => {
                    if (size.checked) {
                        const colorId = color.value;
                        const sizeId = size.value;
                        const colorName = color.dataset.name;
                        const sizeName = size.dataset.name;
                        const rowId = `variant-${colorId}-${sizeId}`;

                        // Kiểm tra nếu dòng đã tồn tại thì không tạo lại
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
                                <td><button type="button" class="btn btn-danger btn-sm remove-variant" data-color="${colorId}" data-size="${sizeId}">X</button></td>
                            `;
                            variantTable.appendChild(row);
                        }
                    }
                });
            }
        });
    }

    colorCheckboxes.forEach(cb => cb.addEventListener('change', updateVariantTable));
    sizeCheckboxes.forEach(cb => cb.addEventListener('change', updateVariantTable));

    // Chỉ xóa 1 dòng khi nhấn nút X
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-variant')) {
            const colorId = e.target.dataset.color;
            const sizeId = e.target.dataset.size;
            const row = document.querySelector(`#variant-${colorId}-${sizeId}`);
            if (row) row.remove();
        }
    });
});
</script>
@endpush


        </tbody>
    </table>
</div>




        <button class="btn btn-success">Thêm</button>
    </form>
</div>
@endsection
