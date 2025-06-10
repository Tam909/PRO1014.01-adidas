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
