<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Thanh Toán - Adidas Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .summary-box {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
      padding: 20px;
      margin-top: 20px;
    }
    .product-name {
      font-weight: 600;
      font-size: 1.1rem;
    }
    .product-detail {
      font-size: 0.9rem;
      color: #555;
    }
    .price-tag {
      color: #d90429;
      font-weight: 700;
    }
    .btn-primary {
      background-color: #0056b3;
      border: none;
      font-weight: 600;
      padding: 12px;
      width: 100%;
      transition: background-color 0.3s ease;
      border-radius: 6px;
    }
    .btn-primary:hover {
      background-color: #003d80;
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


  <div class="container my-4">
    <div class="row">
      <!-- Form thông tin thanh toán -->
      <div class="col-lg-7">
        <h3>Thông tin giao hàng</h3>
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Nhập họ tên" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" placeholder="Nhập email" required />
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" required />
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ cụ thể" required />
          </div>

          <h4>Phương thức thanh toán</h4>
          <div class="mb-4">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="payment" id="cod" checked />
              <label class="form-check-label" for="cod">Thanh toán khi nhận hàng (COD)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="payment" id="vnpay" />
              <label class="form-check-label" for="vnpay">Thanh toán qua VNPay</label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Đặt hàng</button>
        </form>
      </div>

   <!-- Tổng đơn hàng -->
<div class="col-lg-5">
  <div class="summary-box">
    <h4 class="mb-4">Đơn hàng của bạn</h4>

    <div class="mb-3 d-flex align-items-center gap-3">
      <img src="https://via.placeholder.com/80x80.png?text=Áo+Thun" alt="Áo Thun Adidas Originals" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;" />
      <div>
        <div class="product-name">Áo Thun Adidas Originals</div>
        <div class="product-detail">Size M - Màu Đen</div>
        <div class="price-tag mt-2">450,000₫ x 2 = 900,000₫</div>
      </div>
    </div>

    <div class="mb-3 d-flex align-items-center gap-3">
      <img src="https://via.placeholder.com/80x80.png?text=Quần+Jogger" alt="Quần Jogger Adidas" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;" />
      <div>
        <div class="product-name">Quần Jogger Adidas</div>
        <div class="product-detail">Size L - Màu Xám</div>
        <div class="price-tag mt-2">600,000₫ x 1 = 600,000₫</div>
      </div>
    </div>

    <hr />
    <div class="d-flex justify-content-between fw-bold fs-5">
      <div>Tổng cộng</div>
      <div class="price-tag">1,500,000₫</div>
    </div>
  </div>
</div>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
