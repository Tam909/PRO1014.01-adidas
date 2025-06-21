@extends('user.layoutUser')

@section('title', isset($category) ? 'Sản phẩm ' . $category->name : 'Tất Cả Sản Phẩm')

@section('content')
<div class="container mt-4">
    <h1>
        @if(isset($category))
            Sản phẩm theo danh mục: {{ $category->name }}
        @else
            Tất Cả Sản Phẩm
        @endif
    </h1>
    <hr>

    {{-- Phần hiển thị danh mục nếu cần (có thể là sidebar hoặc list các category khác) --}}
    @if($categories->count() > 0)
        <div class="mb-4">
            <h4>Danh mục:</h4>
            @foreach($categories as $cat)
                <a href="{{ route('products.by_category', $cat->id) }}" class="badge bg-primary me-2">{{ $cat->name }}</a>
            @endforeach
        </div>
    @endif

    <div class="row">
        @forelse($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->name }}">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h5>
                    <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>
                    <div class="mt-auto">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                           <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary mt-auto">Xem
                                chi tiết</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p>Chưa có sản phẩm nào trong danh mục này.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>

</div>
@endsection