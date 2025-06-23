<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Favicon -->
<link href="{{ asset('img/favicon.ico') }}" rel="icon">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Emblema+One&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Icon Fonts -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheets -->
<link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

<!-- Customized Bootstrap -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Main Stylesheet -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Header / Navbar -->
    @include('user.partials.header')

    <!-- Nội dung chính -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Bootstrap JS (tùy chọn) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
