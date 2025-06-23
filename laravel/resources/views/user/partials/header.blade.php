  <!-- Header Start -->
  <div class="container-fluid bg-dark px-0">
      <div class="row gx-0 wow fadeIn" data-wow-delay="0.1s">
          <div class="col-lg-3 bg-primary d-none d-lg-block">
              <a href="{{ route('home') }}"
                  class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                  <h1 class="m-0 display-4 text-white text-uppercase">Adidas</h1>
              </a>
          </div>
          <div class="col-lg-9">

              <nav class="navbar navbar-expand-lg navbar-dark p-3 p-lg-0 px-lg-5" style="background: #111111;">
                  <a href="index.html" class="navbar-brand d-block d-lg-none">
                      <h1 class="m-0 display-4 text-primary text-uppercase">Chefer</h1>
                  </a>
                  <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                      data-bs-target="#navbarCollapse">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                      {{-- Trang Chủ --}}
                      <a href="{{ route('home') }}" class="nav-item nav-link @if(Route::currentRouteNamed('home')) active @endif">Trang Chủ</a>
                  
                      {{-- Sản Phẩm --}}
                      {{-- Điều kiện cho 'Sản Phẩm' cần phức tạp hơn một chút vì nó bao gồm cả list và category --}}
                      <a href="{{ route('products.list') }}" class="nav-item nav-link @if(Route::currentRouteNamed('products.list') || Route::currentRouteNamed('products.by_category') || Route::currentRouteNamed('products.show')) active @endif">Sản Phẩm</a>
                  
                      {{-- Liên Hệ --}}
                      <a href="{{ route('contact.show') }}" class="nav-item nav-link @if(Route::currentRouteNamed('contact.show')) active @endif">Liên Hệ</a>
                  
                      {{-- Giới Thiệu (Giả sử bạn có route tên 'about') --}}
                      <a href="{{ route('about') }}" class="nav-item nav-link @if(Route::currentRouteNamed('about')) active @endif">Giới Thiệu</a>
                  
                      {{-- Các Nhãn Hiệu (Giả sử bạn có route tên 'brands') --}}
                      {{-- <a href="{{ route('brands') }}" class="nav-item nav-link @if(Route::currentRouteNamed('brands')) active @endif">Các Nhãn Hiệu</a> --}}
                  </div>
                      <div class="d-none d-lg-flex align-items-center py-2">
                          @auth
                              <li class="nav-item me-2">
                                  <span class="text-white">👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
                              </li>
                              <li class="nav-item me-2">
                                  @if (Auth::user()->role === 'admin')
                                      <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">🔧 Quản
                                          trị</a>
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
                      </div>
                  </div>
              </nav>
          </div>
      </div>
  </div>
  <!-- Header End -->
