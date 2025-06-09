@extends('user.layoutUser')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <h1 class="mb-4">Danh sách sản phẩm</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($products as $product)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Không có sản phẩm nào.</p>
        @endforelse
    </div>
@endsection


