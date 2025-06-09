@extends('user.layoutUser')

@section('title', 'Giỏ Hàng Của Bạn - Adidas')

@section('style')
<style>
    .cart-item-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }
    .summary-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
    <h1 class="mb-4 text-center">Giỏ Hàng Của Bạn</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($cart && $cart->cartDetail->count() > 0)
        <div class="row">
            {{-- Danh sách sản phẩm --}}
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Các sản phẩm trong giỏ</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($cart->cartDetail as $detail)
                            <div class="row align-items-center mb-3 pb-3 border-bottom">
                                <div class="col-md-2 text-center">
                                    @if ($detail->product && $detail->product->img)
                                        <img src="{{ asset('storage/' . $detail->product->img) }}" alt="{{ $detail->product->name }}" class="img-fluid cart-item-image">
                                    @else
                                        <img src="https://via.placeholder.com/100" alt="No Image" class="img-fluid cart-item-image">
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <h5>{{ $detail->product->name }}</h5>
                                    <p class="text-muted mb-0">Giá: {{ number_format($detail->money, 0, ',', '.') }}₫</p>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control text-center" value="{{ $detail->quantity }}" min="1" max="99">
                                </div>
                                <div class="col-md-2 text-end">
                                    <p class="fw-bold mb-0">{{ number_format($detail->total_money, 0, ',', '.') }}₫</p>
                                </div>
                                <div class="col-md-1 text-end">
                                    <form action="{{ route('cart.destroy', ['id_detail' => $detail->id_detail]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white text-end">
                        <h4 class="mb-0">Tổng cộng: <span class="text-primary">{{ number_format($cart->total_money, 0, ',', '.') }}₫</span></h4>
                    </div>
                </div>
            </div>

            {{-- Tóm tắt đơn hàng --}}
            <div class="col-lg-4">
                <div class="summary-card">
                    <h4 class="mb-3">Tóm tắt đơn hàng</h4>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Tổng sản phẩm: <span>{{ $cart->cartDetail->sum('quantity') }}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Tổng tiền hàng: <span>{{ number_format($cart->total_money, 0, ',', '.') }}₫</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Phí vận chuyển: <span>0₫</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold fs-5 text-primary">Tổng thanh toán: <span>{{ number_format($cart->total_money, 0, ',', '.') }}₫</span></li>
                    </ul>
                    <a href="#" class="btn btn-success btn-lg w-100 mb-2">Tiến hành đặt hàng</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary w-100">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center p-5 border rounded shadow-sm">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
            <h3 class="mb-3">Giỏ hàng của bạn đang trống!</h3>
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3">Quay lại mua sắm</a>
        </div>
    @endif
@endsection
