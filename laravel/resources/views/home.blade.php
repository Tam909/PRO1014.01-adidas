<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trang Chủ - Adidas</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Adidas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#">Trang Chủ</a></li>
        <a class="nav-link" href="{{ route('products.index') }}">Sản Phẩm</a>
        <li class="nav-item"><a class="nav-link" href="#">Giới Thiệu</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Liên Hệ</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="bg-light text-center p-5">
  <div class="container">
    <h1 class="display-4 fw-bold mb-3">Chào mừng đến với Adidas</h1>
    <p class="lead mb-4">Nơi cung cấp các sản phẩm chất lượng với giá tốt nhất.</p>
    <a href="#" class="btn btn-primary btn-lg">Khám phá ngay</a>
  </div>
</section>

<!-- Features Section -->
<section class="py-5">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm">
          <h3>Chất lượng hàng đầu</h3>
          <p>Sản phẩm được tuyển chọn kỹ lưỡng, đảm bảo độ bền và độ an toàn cao.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm">
          <h3>Giao hàng nhanh chóng</h3>
          <p>Đơn hàng của bạn được xử lý và giao đến tận tay trong thời gian sớm nhất.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm">
          <h3>Hỗ trợ 24/7</h3>
          <p>Đội ngũ chăm sóc khách hàng luôn sẵn sàng giải đáp mọi thắc mắc của bạn.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Product Highlights -->
<section class="bg-primary text-white py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Sản phẩm nổi bật</h2>
    <div class="row">
      @foreach ($products as $product)
          <div class="col-md-4 mb-4">
              <div class="card h-100">
                <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body d-flex flex-column">
                      <h5 class="card-title">{{ $product->name }}</h5>
                      <p class="card-text text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                      <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary mt-auto">Xem chi tiết</a>
                  </div>
              </div>
          </div>
      @endforeach
  </div>

  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  <div class="container">
    &copy; 2025 . Bản quyền thuộc về Adidas.
  </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
