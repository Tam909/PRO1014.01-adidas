<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CHEFER - Chef Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{ asset('https://fonts.googleapis.com')  }}">
    <link rel="preconnect" href="{{ asset('https://fonts.gstatic.com') }}" crossorigin>
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Emblema+One&family=Poppins:wght@400;600&display=swap') }}"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet') }}">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet') }}">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


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
                            <a href="{{ route('home')}}" class="nav-item nav-link active">Trang Chủ</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sản Phẩm</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="feature.html" class="dropdown-item">Bóng đá</a>
                                    <a href="blog.html" class="dropdown-item">Chạy</a>
                                    <a href="testimonial.html" class="dropdown-item">Bóng rổ</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Liên Hệ</a>
                            <a href="contact.html" class="nav-item nav-link">Giới Thiệu</a>
                            <a href="contact.html" class="nav-item nav-link">Các Nhãn Hiệu</a>
                        </div>
                        <div class="d-none d-lg-flex align-items-center py-2">
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
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Hero Start -->
    <div class="container-fluid p-5 mb-5 bg-dark text-secondary">
        <div class="row g-5 py-5">
            <div class="mb-4 wow fadeIn text-center" data-wow-delay="0.2s" >
                <h5 class="section-title ">FIND YOUR TEAM</h5>
                <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="">
                    <img class="img-fluid rounded mb-3 " src="img/2.png">
                </a>
                <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="">
                    <img class="img-fluid rounded mb-3 " src="img/3.png">
                </a>
                <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="">
                    <img class="img-fluid rounded mb-3 " src="img/4.png">
                </a>
                <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="">
                    <img class="img-fluid rounded mb-3 " src="img/5.png">
                </a>
                <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="">
                    <img class="img-fluid rounded mb-3 " src="img/6.png">
                </a>
            </div>
           
            <div class=" wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid rounded mb-3 " src="img/slide.gif" alt="">
                <h3 class="text-center"  style="background-color: aliceblue"   >ADICOLOR</h3>
                <p class="mb-0" >Biểu tượng không thể phủ nhận. Và chính bạn làm nên điều đó.</p>
            </div>
        
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid p-5">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded-circle rounded-bottom rounded-end"
                        src="img/abc.jpg" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="mb-4 wow fadeIn" data-wow-delay="0.2s">
                    <h5 class="section-title">Adidas</h5>
                    <h1 class="display-3 mb-0">Adidas mang đến trải nghiệm và trách nhiệm</h1>
                </div>
                <p class="mb-4 wow fadeIn" data-wow-delay="0.3s">Thể thao nâng cao sức khoẻ. Giúp bạn luôn tĩnh tâm. 
                    Kết nối chúng ta. Thông qua thể thao, chúng ta có sức mạnh để thay đổi cuộc sống—bằng những câu chuyện 
                    về các vận động viên truyền cảm hứng, công nghệ đột phá và bằng cách giúp bạn đứng lên và vận động.
                </p>
                <div class="row">
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                        <div class="bg-light rounded p-4">
                            <img class="img-fluid bg-primary rounded-circle mb-3" src="img/a.avif" style="width: 80px; height: 80px;">
                            <h4>Sale 70 %</h4>
                            <p class="mb-0">
                                Tri ân khách hàng với chương trình giảm giá lên đến 70% cho các sản phẩm thể thao.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-light rounded p-4">
                            <img class="img-fluid bg-primary rounded-circle mb-3" src="img/7.jpg" style="width: 80px; height: 80px;">
                            <h4>Adidas QA68</h4>
                            <p class="mb-0">Sản phẩm mới mang lại cảm giác chân thân và mềm mại hơn từ nhà chúng tôi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Facts Start -->
    <div class="container-fluid bg-dark facts p-5 my-5 ">
        <div class="row gx-5 gy-4 py-5 ">
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="d-flex">
                    <div class="ps-4">
                        <h5 class="text-white">340Tr+</h5>
                        <h1 class=" text-secondary mb-0" data-toggle="counter-up">Sản Phẩm</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="d-flex">
                    <div class="ps-4">
                        <h5 class="text-white">500Tr+</h5>
                        <h1 class=" text-secondary mb-0" data-toggle="counter-up">Khách Hàng</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="d-flex">
                    <div class="ps-4">
                        <h5 class="text-white">62.035</h5>
                        <h1 class="display-5 text-secondary mb-0" data-toggle="counter-up">Nhân Viên</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="d-flex">
                    <div class="ps-4">
                        <h5 class="text-white">23,7 tỷ euro</h5>
                        <h1 class="display-5 text-secondary mb-0" data-toggle="counter-up">Doanh Thu</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Feature Start -->
    <div class="container-fluid feature position-relative p-5 pb-0 mt-5">
        <div class="row g-3 gb-3">
            @foreach ($products->take(3) as $product)
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
    <!-- Feature End -->


    <!-- Team Start -->
    <div class="container-fluid p-5">
        <div class="mb-5 text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px; margin: auto;">
            <h5 class="section-title">professional leadership</h5>
            <h1 class="display-3 mb-0">Đội Ngũ Điều Hành</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="team-item position-relative">
                    <div class="position-relative overflow-hidden rounded-circle rounded-bottom rounded-end">
                        <img class="img-fluid w-100" src="img/anh1.avif" alt="">
                    </div>
                    <div class="position-absolute start-0 bottom-0 d-flex flex-column justify-content-center w-100  rounded-bottom text-center"
                        style="height: 100px;  background: rgba(34, 36, 41, .9);">
                        <h5 class="text-light">Bjørn Gulden</h5>
                        <p class="small text-uppercase text-secondary m-0" style="letter-spacing: 3px;">Tổng Giám đốc Điều hành</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="team-item position-relative">
                    <div class="position-relative overflow-hidden rounded-circle rounded-bottom rounded-end">
                        <img class="img-fluid w-100" src="img/anh2.jpg" alt="">
                      
                    </div>
                    <div class="position-absolute start-0 bottom-0 d-flex flex-column justify-content-center w-100 rounded-bottom text-center"
                        style="height: 100px; background: rgba(34, 36, 41, .9);">
                        <h5 class="text-light">Harm Ohlmeyer </h5>
                        <p class="small text-uppercase text-secondary m-0" style="letter-spacing: 3px;">Giám đốc Tài chính</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="team-item position-relative">
                    <div class="position-relative overflow-hidden rounded-circle rounded-bottom rounded-end">
                        <img class="img-fluid w-100" src="img/anh3.jpg" alt="">
                    </div>
                    <div class="position-absolute start-0 bottom-0 d-flex flex-column justify-content-center w-100 rounded-bottom text-center"
                        style="height: 100px; background: rgba(34, 36, 41, .9);">
                        <h5 class="text-light">Thomas Rabe</h5>
                        <p class="small text-uppercase text-secondary m-0" style="letter-spacing: 3px;">Chủ tịch Hội đồng Giám sát</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Blog Start -->
    <div class="container-fluid p-5">
        <div class="mb-5 text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px; margin: auto;">
            <h5 class="section-title">Our Blog</h5>
            <h1 class="display-3 mb-0">Sản Phẩn Nổi Bật</h1>
        </div>
        <div class="row g-5">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden rounded-top">
                        <img class="img-fluid" src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="bg-dark d-flex align-items-center rounded-bottom p-4">
                        <div class="flex-shrink-0 text-center text-secondary border-end border-secondary pe-3 me-3">
                            <span>{{ $product->created_at->format('d') }}</span>
                            <h6 class="text-primary text-uppercase mb-0">{{ $product->created_at->format('F') }}</h6>
                            <span>{{ $product->created_at->format('Y') }}</span>
                        </div>
                        <a class="h5 lh-base text-light" href="{{ route('products.show', $product->id) }}">
                            {{ $product->name }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Blog End -->


    <!-- Instagram Start -->
    <div class="container-fluid position-relative instagram p-0 mt-5">
        <a href="" class="d-flex align-items-center justify-content-center position-absolute top-50 start-50 translate-middle bg-white rounded-circle" style="width: 100px; height: 100px; z-index: 1;">
            <i class="fab fa-instagram fa-2x text-secondary"></i>
        </a>
        <div class="row g-0">
            <div class="col-lg-2 col-md-3 col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid" src="img/normal(1).jpg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 wow fadeIn" data-wow-delay="0.2s">
                <img class="img-fluid" src="img/normal(2).jpg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                <img class="img-fluid" src="img/normal(3).jpg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 wow fadeIn" data-wow-delay="0.4s">
                <img class="img-fluid" src="img/normal(4).jpg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                <img class="img-fluid" src="img/normal(5).jpg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 wow fadeIn" data-wow-delay="0.6s">
                <img class="img-fluid" src="img/normal.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Instagram End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary px-5">
        <div class="row gx-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <h3 class="text-light mb-4">Get In Touch</h3>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            <p class="mb-0">123 Street, New York, USA</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-primary me-2"></i>
                            <p class="mb-0">info@example.com</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-primary me-2"></i>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                        <div class="d-flex mt-4">
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle" href="#"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h3 class="text-light mb-4">Quick Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Food Menu</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Our Chefs</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-secondary" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h3 class="text-light mb-4">More Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Food Menu</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Our Chefs</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-secondary" href="#"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 p-5"
                    style="background: #111111;">
                    <h3 class="text-white mb-4">Newsletter</h3>
                    <h6 class="text-uppercase text-light mb-2">Subscribe Our Newsletter</h6>
                    <p class="small text-secondary">Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 py-lg-0 px-5" style="background: #111111;">
        <div class="row gx-5">
            <div class="col-lg-8">
                <div class="py-lg-4 text-center">
                    <p class="text-secondary mb-0">&copy; <a class="text-light fw-bold" href="#">Your Site Name</a>. All
                        Rights Reserved. Distributed by <a class="text-light fw-bold"
                            href="https://themewagon.com">ThemeWagon</a></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="py-lg-4 text-center credit">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    <p class="text-light mb-0">Designed by <a class="text-light fw-bold" target="_blank"
                            href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-dark py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>