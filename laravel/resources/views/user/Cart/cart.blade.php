<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f8;
            font-family: 'Poppins', sans-serif;
        }

        .checkout-container {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .summary-box {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        h3,
        h4 {
            font-weight: 600;
            color: #212529;
        }

        .form-label {
            font-weight: 500;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-item img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 15px;
        }

        .product-name {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .product-detail {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .price-tag {
            color: #d90429;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .btn-order {
            background-color: #002b5b;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s ease;
            width: 100%;
            border: none;
        }

        .btn-order:hover {
            background-color: #001d3d;
        }

        .total-box {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 20px;
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

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🏃 Adidas Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('carts.index') }}">Giỏ hàng</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item me-3 text-white">👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></li>
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item me-2"><a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">🔧 Admin</a></li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">@csrf
                            <button class="btn btn-outline-light btn-sm">Đăng xuất</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item me-2"><a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Đăng nhập</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-light btn-sm">Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>


    <div class="container my-5">
        <h1 class="mb-4 text-center">Giỏ Hàng Của Bạn</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($cart && $cart->cartDetail->count() > 0)
        <div class="row">
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
                                <img src="{{ asset('storage/' . $detail->product->img) }}"
                                    alt="{{ $detail->product->name }}" class="img-fluid cart-item-image">
                                @else
                                <img src="https://via.placeholder.com/100" alt="No Image"
                                    class="img-fluid cart-item-image">
                                @endif
                            </div>
                            <div class="col-md-5">
                                <h5>{{ $detail->product->name }}</h5>
                                <p class="text-muted mb-0">Giá:
                                    {{ number_format($detail->money, 0, ',', '.') }}₫
                                </p>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-sm">
                                    <input type="number" name="quantity" class="form-control text-center"
                                        value="{{ $detail->quantity }}" min="1" max="99">
                                </div>

                            </div>
                            <div class="col-md-2 text-end">
                                <p class="fw-bold mb-0">{{ number_format($detail->total_money, 0, ',', '.') }}₫
                                </p>
                            </div>
                            <div class="col-md-1 text-end">
                                <form action="{{ route('cart.destroy', ['id_detail' => $detail->id_detail]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Xóa sản phẩm"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white text-end">
                        <h4 class="mb-0">Tổng cộng: <span
                                class="text-primary">{{ number_format($cart->total_money, 0, ',', '.') }}₫</span>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <h4 class="mb-3">Tóm tắt đơn hàng</h4>
                    <ul class="list-group list-group-flush mb-3">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Tổng sản phẩm:
                            <span>{{ $cart->cartDetail->sum('quantity') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            Tổng tiền hàng:
                            <span>{{ number_format($cart->total_money, 0, ',', '.') }}₫</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 mb-3">
                            Phí vận chuyển:
                            <span>0₫</span>
                        </li>
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 fw-bold fs-5 text-primary">
                            Tổng thanh toán:
                            <span>{{ number_format($cart->total_money, 0, ',', '.') }}₫</span>
                        </li>
                    </ul>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg w-100 mb-2">Tiến hành đặt hàng</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary w-100">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center p-5 border rounded shadow-sm">
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

</body>

</html>