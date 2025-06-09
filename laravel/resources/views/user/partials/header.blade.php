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
                            <a href="{{ route('home') }}" class="nav-item nav-link active">Trang Chủ</a>
                            
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sản
                                    Phẩm</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach ($categories as $category)
                                        <a href="#" class="dropdown-item">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <a href="contact.html" class="nav-item nav-link">Liên Hệ</a>
                            <a href="contact.html" class="nav-item nav-link">Giới Thiệu</a>
                            <a href="contact.html" class="nav-item nav-link">Các Nhãn Hiệu</a>
                        </div>
                        <div class="d-none d-lg-flex align-items-center py-2">
    <ul class="navbar-nav flex-row align-items-center m-0">
        @auth
            <li class="nav-item me-3">
                <span class="text-white">👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
            </li>
            @if (Auth::user()->role === 'admin')
                <li class="nav-item me-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">🔧 Quản trị</a>
                </li>
            @endif
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
            </div>
        </div>
    </div>