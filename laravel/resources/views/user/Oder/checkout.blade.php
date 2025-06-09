<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Thanh Toán - Adidas Store</title>
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


  <div class="container checkout-container">
    <div class="row">
      <div class="col-lg-7 mb-4">
        <div class="summary-box">
          <h3>Thông tin giao hàng</h3>
          <form action="{{ route('checkout.placeOrder') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Họ tên</label>
              <input type="text" id="name" name="name" class="form-control"
                value="{{ old('name', $user->name ?? '') }}" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control"
                value="{{ old('email', $user->email ?? '') }}" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Số điện thoại</label>
              <input type="text" id="phone" name="phone" class="form-control"
                value="{{ old('phone', $user->phone ?? '') }}" required>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Địa chỉ</label>
              <input type="text" id="address" name="address" class="form-control"
                value="{{ old('address', $user->address ?? '') }}" required>
            </div>
            <div class="mb-4">
              <label class="form-label">Phương thức thanh toán</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="cod" value="0" required>
                <label class="form-check-label" for="cod">Thanh toán khi nhận hàng</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="bank" value="1">
                <label class="form-check-label" for="bank">Chuyển khoản</label>
              </div>
            </div>
            @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show mt-3" role="alert">
              <strong><i class="bi bi-check-circle"></i> Thành công!</strong> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
              setTimeout(function() {
                var alert = document.getElementById('success-alert');
                if (alert) {
                  var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                  bsAlert.close();
                }
              }, 3000);
            </script>
            @endif

            <button type="submit" class="btn-order">🛒 Đặt hàng ngay</button>
          </form>
        </div>
      </div>

      <!-- Đơn hàng -->
      <div class="col-lg-5">
        <div class="summary-box">
          <h4>Đơn hàng của bạn</h4>
          @if($cart && $cart->cartDetail->count() > 0)
          @foreach($cart->cartDetail as $item)
          <div class="product-item">
            <img src="{{ optional($item->product)->image ?? 'https://via.placeholder.com/80' }}"
              alt="{{ optional($item->product)->name }}">
            <div>
              <div class="product-name">{{ optional($item->product)->name }}</div>
              <div class="product-detail">Size {{ $item->size ?? 'N/A' }} | Màu {{ $item->color ?? 'N/A' }}</div>
              <div class="price-tag mt-1">
                {{ number_format($item->money, 0, ',', '.') }}₫ x {{ $item->quantity }} =
                {{ number_format($item->total_money, 0, ',', '.') }}₫
              </div>
            </div>
          </div>
          @endforeach
          <hr>
          <div class="total-box d-flex justify-content-between">
            <span>Tổng cộng:</span>
            <span class="price-tag">{{ number_format($cart->total_money, 0, ',', '.') }}₫</span>
          </div>
          @else
          <p>🛒 Giỏ hàng của bạn đang trống.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>