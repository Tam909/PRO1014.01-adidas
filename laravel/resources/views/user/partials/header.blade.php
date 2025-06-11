<!-- Header Start -->
<div class="container-fluid bg-dark px-0">
    <div class="row gx-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="col-lg-3 bg-primary d-none d-lg-flex align-items-center justify-content-center">
            <a href="{{ route('home') }}" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 display-4 text-white text-uppercase">Adidas</h1>
            </a>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-dark p-3 p-lg-0 px-lg-5" style="background: #111111;">
                <a href="{{ route('home') }}" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary text-uppercase">Adidas</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link @if(Route::currentRouteNamed('home')) active @endif">Trang Chủ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.list') }}" class="nav-link @if(Route::currentRouteNamed('products.list') || Route::currentRouteNamed('products.by_category') || Route::currentRouteNamed('products.show')) active @endif">Sản Phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact.show') }}" class="nav-link @if(Route::currentRouteNamed('contact.show')) active @endif">Liên Hệ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}" class="nav-link @if(Route::currentRouteNamed('about')) active @endif">Giới Thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('carts.index') }}" class="nav-link">
                                Giỏ Hàng
                                @if (session('cart'))
                                    <span class="badge bg-warning text-dark ms-1">
                                        {{ session('cart')->cartDetail->count() }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav d-none d-lg-flex align-items-center mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item me-3 text-white">
                                👋 Xin chào, <strong>{{ Auth::user()->name }}</strong>
                            </li>
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item me-2">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">🔧 Quản trị</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
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
            </nav>
        </div>
    </div>
</div>
<!-- Header End -->
