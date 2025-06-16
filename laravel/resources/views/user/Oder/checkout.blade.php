@extends('user.layoutUser')

@section('title', 'Thanh Toán - Adidas Store')

@section('content')
<div class="container py-5">
  <div class="row g-4">
    <!-- Thông tin giao hàng -->
    <div class="col-lg-7">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Thông tin giao hàng</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('checkout.placeOrder') }}" method="POST" novalidate>
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label fw-semibold">Họ tên <span class="text-danger">*</span></label>
              <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name ?? '') }}" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
              <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email ?? '') }}" required>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label fw-semibold">Số điện thoại <span class="text-danger">*</span></label>
              <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $user->phone ?? '') }}" required>
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="address" class="form-label fw-semibold">Địa chỉ <span class="text-danger">*</span></label>
              <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address', $user->address ?? '') }}" required>
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

           <fieldset class="mb-4">
    <legend class="col-form-label fw-semibold mb-2">Phương thức thanh toán <span class="text-danger">*</span></legend>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="payment" id="cod" value="0" required
        {{ old('payment') == '0' ? 'checked' : '' }}>
      <label class="form-check-label" for="cod">Thanh toán khi nhận hàng</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="payment" id="bank" value="1"
        {{ old('payment') == '1' ? 'checked' : '' }}>
      <label class="form-check-label" for="bank">Thanh toán Online</label>
    </div>
    @error('payment')
      <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
  </fieldset>

            @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle-fill"></i>
              <strong> Thành công! </strong> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
              setTimeout(function () {
                var alert = document.getElementById('success-alert');
                if (alert) {
                  var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                  bsAlert.close();
                }
              }, 3000);
            </script>
            @endif

            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">🛒 Đặt hàng ngay</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Đơn hàng -->
    <div class="col-lg-5">
      <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0">Đơn hàng của bạn</h5>
        </div>
        <div class="card-body">
          @if($cart && $cart->cartDetail->count() > 0)
           @foreach($cart->cartDetail as $item)
@php
  $variant = $item->varianti;
  $product = $item->product;
@endphp
<div class="d-flex align-items-center mb-3 border-bottom pb-2">
   <img src="{{ $item->product && $item->product->img ? asset('storage/' . $item->product->img) : 'https://via.placeholder.com/80' }}"
     alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">

  <div class="flex-grow-1">
    <h6 class="mb-1">{{ $product->name }}</h6>
    <small class="text-muted">
      Size: {{ $variant->size->name ?? 'N/A' }} |
      Màu: {{ $variant->color->name ?? 'N/A' }}
    </small>
    <div class="mt-1 text-primary fw-semibold">
      {{ number_format($item->money, 0, ',', '.') }}₫ × {{ $item->quantity }} =
      {{ number_format($item->total_money, 0, ',', '.') }}₫
    </div>
  </div>
</div>
@endforeach
            <hr>
            <div class="d-flex justify-content-between align-items-center fw-bold fs-5">
              <span>Tổng cộng:</span>
              <span class="text-danger">{{ number_format($cart->total_money, 0, ',', '.') }}₫</span>
            </div>
          @else
            <p class="text-center text-muted fs-6">🛒 Giỏ hàng của bạn đang trống.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
