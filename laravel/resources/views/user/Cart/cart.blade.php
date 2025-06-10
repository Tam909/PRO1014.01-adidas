@extends('user.layoutUser')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: #f4f6f8;
            font-family: 'Poppins', sans-serif;
        }

        .summary-card, .card {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
        }

        .btn-order {
            background-color: #002b5b;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            border: none;
        }

        .btn-order:hover {
            background-color: #001d3d;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }

        .nav-link {
            font-weight: 500;
        }
    </style>
</head>

@section('content')


<div class="container my-5">
    <h1 class="mb-4 text-center">🛒 Giỏ Hàng Của Bạn</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($cart && $cart->cartDetail->count() > 0)
    <div class="row">
        <!-- Left: Cart Items -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Các sản phẩm trong giỏ</h5>
                </div>
                <div class="card-body">
                    @foreach ($cart->cartDetail as $detail)
                        <div class="row align-items-center mb-3 pb-3 border-bottom">
                            <div class="col-md-2 text-center">
                                <img src="{{ $detail->product && $detail->product->img ? asset('storage/' . $detail->product->img) : 'https://via.placeholder.com/100' }}"
                                     alt="{{ $detail->product->name }}" class="img-fluid cart-item-image">
                            </div>
                            <div class="col-md-5">
                                <h5>{{ $detail->product->name }}</h5>
                                <p class="text-muted mb-0">Giá: {{ number_format($detail->money, 0, ',', '.') }}₫</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control form-control-sm text-center" value="{{ $detail->quantity }}" min="1" max="99" readonly>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="fw-bold mb-0">{{ number_format($detail->total_money, 0, ',', '.') }}₫</p>
                            </div>
                            <div class="col-md-1 text-end">
                                <form action="{{ route('cart.destroy', ['id_detail' => $detail->id_detail]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Xóa sản phẩm">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

        <!-- Right: Summary -->
        <div class="col-lg-4">
            <div class="summary-card bg-white p-4">
                <h4 class="mb-3">Tóm tắt đơn hàng</h4>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between">Tổng sản phẩm: <span>{{ $cart->cartDetail->sum('quantity') }}</span></li>
                    <li class="list-group-item d-flex justify-content-between">Tổng tiền hàng: <span>{{ number_format($cart->total_money, 0, ',', '.') }}₫</span></li>
                    <li class="list-group-item d-flex justify-content-between">Phí vận chuyển: <span>0₫</span></li>
                    <li class="list-group-item d-flex justify-content-between fw-bold fs-5 text-primary">
                        Tổng thanh toán: <span>{{ number_format($cart->total_money, 0, ',', '.') }}₫</span>
                    </li>
                </ul>
                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg w-100 mb-2">Tiến hành đặt hàng</a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary w-100">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
    @else
    <div class="text-center p-5 border rounded shadow-sm bg-white">
        <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
        <h3 class="mb-3">Giỏ hàng của bạn đang trống!</h3>
        <p class="text-muted">Hãy thêm một vài sản phẩm tuyệt vời vào giỏ hàng của bạn.</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3">Quay lại mua sắm</a>
    </div>
    @endif
</div>

<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        &copy; 2025 . Bản quyền thuộc về Adidas.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
