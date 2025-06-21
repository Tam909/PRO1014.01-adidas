<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin | @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding-top: 1rem;
        }
        .sidebar a {
            color: white;
            padding: 0.75rem 1.25rem;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 2rem;
        }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')
    <div class="content">
        @include('admin.partials.header')
        @yield('content')
    </div>
</body>
</html>
@stack('scripts')
