@extends('user.layoutUser')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <div class="container my-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row g-4">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p><strong>Danh mục:</strong> {{ $product->category->name ?? 'Chưa có danh mục' }}</p>
                <h4 class="text-danger">{{ number_format($product->price, 0, ',', '.') }}₫</h4>
                <p>{{ $product->description }}</p>
                <p>
                    <strong>Trạng thái: </strong>
                    @if ($product->status == 0)
                        <span class="badge bg-success">Hoạt động</span>
                    @else
                        <span class="badge bg-secondary">Không hoạt động</span>
                    @endif
                </p>

                <form method="POST" action="{{ route('cart.add', $product->id) }}">
    @csrf

    {{-- Chọn màu --}}
    <div class="mb-3">
        <label for="color_id" class="form-label">Chọn màu:</label>
        <select name="color_id" id="color_id" class="form-select" required>
            <option value="">-- Chọn màu --</option>
            @foreach ($product->variants->unique('id_color') as $variant)
                <option value="{{ $variant->id_color }}">
                    {{ $variant->color->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Chọn size --}}
    <div class="mb-3">
        <label for="size_id" class="form-label">Chọn size:</label>
        <select name="size_id" id="size_id" class="form-select" required>
            <option value="">-- Chọn size --</option>
            @foreach ($product->variants->unique('id_size') as $variant)
                <option value="{{ $variant->id_size }}">
                    {{ $variant->size->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Số lượng --}}
    <div class="mb-3">
        <label for="quantity" class="form-label">Số lượng</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1"
            class="form-control" style="max-width: 100px;">
    </div>

    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
</form> 

            </div>
        </div>
    </div>

  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection
