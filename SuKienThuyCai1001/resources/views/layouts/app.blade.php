<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SuKienThuyCai')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">SuKienThuyCai</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dich-vu/tiec-cuoi">Dịch vụ tiệc cưới</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/equipment">Thiết bị</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Tin tức</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Địa chỉ: 25 Tông Đản, Hoàn Kiếm, Hà Nội</p>
                    <p>Điện thoại: 0366.898.984</p>
                    <p>Email: info@sukienthuycai.com</p>
                </div>
                <div class="col-md-4">
                    <h5>Dịch vụ</h5>
                    <ul class="list-unstyled">
                        <li><a href="/dich-vu/tiec-cuoi">Tiệc cưới</a></li>
                        <li><a href="#">Tiệc công ty</a></li>
                        <li><a href="#">Hội nghị</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <div class="social-links">
                        <a href="#" class="me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
    
    @yield('scripts')
</body>
</html> 