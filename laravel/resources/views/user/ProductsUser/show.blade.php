<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Chi tiết sản phẩm - {{ $product->name }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        <li class="nav-item"><a class="nav-link active" href="{{route('home')}}">Trang Chủ</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Sản Phẩm</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Giới Thiệu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('carts.index')}}">Giỏ Hàng</a></li>

      </ul>

      <ul class="navbar-nav ms-auto align-items-center">
        @auth
          <li class="nav-item me-2">
            <span class="text-white">👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
          </li>
          <li class="nav-item me-2">
            @if(Auth::user()->role === 'admin')
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
  @if(session('success'))
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
        @if($product->status == 0)
          <span class="badge bg-success">Hoạt động</span>
        @else
          <span class="badge bg-secondary">Không hoạt động</span>
        @endif
      </p>

     <form method="POST" action="{{ route('cart.add', $product->id) }}">
    @csrf
    <div class="mb-3">
        <label for="quantity" class="form-label">Số lượng</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control" style="max-width: 100px;">
    </div>
    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
</form>

    </div>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3">
  <div class="container">
    &copy; 2025 . Bản quyền thuộc về Adidas.
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
