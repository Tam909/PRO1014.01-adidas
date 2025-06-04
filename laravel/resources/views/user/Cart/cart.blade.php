<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Giỏ Hàng Của Bạn - Adidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Adidas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sản Phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ route('carts.index') }}">Giỏ Hàng</a></li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item me-2">
                            <span class="text-white">👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
                        </li>
                        <li class="nav-item me-2">
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">🔧 Quản trị</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-light btn-sm" type="submit">Đăng xuất</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light btn-sm" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mb-4 text-center">Giỏ Hàng Của Bạn</h1>
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
                                            {{ number_format($detail->money, 0, ',', '.') }}₫</p>
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
                                        <form action="#" method="POST">
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
