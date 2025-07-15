<!DOCTYPE html>
<html lang="en">

<head>
    <link href="img/favicon.ico" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/style2.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <style>
        body {
            padding-top: 70px; /* Adjusted to approximate navbar height (refine if needed) */
            font-family: 'Poppins', sans-serif;
            background-color: #f5e8d8;
            margin: 0; /* Ensure no default body margin */
        }

        /* Prevent extra margins on containers */
        .container-fluid, .container {
            margin-top: 0 !important;
        }

        /* ... (keep all other existing styles) ... */

        .navbar-nav .nav-link {
            transition: 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            color: #d35400;
        }

        .btn-dark {
            transition: 0.3s ease-in-out;
        }

        .btn-dark:hover {
            background-color: #d35400;
            border-color: #d35400;
        }

        /* Add this for vertical alignment in the navbar */
        .navbar-nav .nav-item,
        .navbar-brand,
        .navbar-brand img,
        .navbar-toggler,
        .navbar-toggler-icon,
        .navbar form,
        .navbar .profile-img,
        .navbar .profile-dropdown .dropdown-item {
            display: flex;
            align-items: center;
        }

        @media (max-width: 992px) {
            .navbar .profile-img {
                margin-top: 1rem;
            }
        }

        .custom-footer {
            background-color: #ffffff !important;
            color: #EDE0D4 !important;
            padding: 50px 0 !important;
        }

        .custom-footer a {
            color: #191919 !important;
            text-decoration: none !important;
        }

        .custom-footer a:hover {
            text-decoration: underline !important;
        }

        .footer-title {
            font-weight: bold !important;
            text-transform: uppercase !important;
            font-size: 16px !important;
            margin-bottom: 15px !important;
        }

        .footer-list {
            list-style: none !important;
            padding: 0 !important;
        }

        .footer-list li {
            margin-bottom: 8px !important;
        }

        .newsletter-section {
            background-color: #F5EDE0 !important;
            padding: 20px !important;
            text-align: center !important;
            margin-bottom: 30px !important;
        }

        .newsletter-section input {
            border-radius: 20px !important;
            border: 1px solid #8B5E3C !important;
            padding: 8px 15px !important;
            width: 60% !important;
        }

        .newsletter-section button {
            background-color: #3D2B23;
            color: white;
            border-radius: 20px;
            padding: 8px 20px;
            border: none;
            margin-left: 10px;
        }

        .newsletter-section button:hover {
            background-color: #523C31 !important;
        }

        .social-icons a {
            font-size: 20px !important;
            margin-right: 15px !important;
            color: #EDE0D4 !important;
        }

        .social-icons a:hover {
            color: #C49A6C !important;
        }

        .cover-section {
            position: relative;
            background: url('{{ asset(' images/cafePic.jpg') }}') no-repeat center center/cover;
            height: 90vh;
            display: flex;
            align-items: center;
            padding-left: 10%;
            color: white;
        }

        .cover-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }

        .cover-content {
            position: relative;
            z-index: 1;
        }

        .cover-content h2 {
            color: #d35400;
            font-size: 20px;
            font-weight: 400;
        }

        .cover-content h1 {
            color: #d35400;
            font-size: 42px;
            font-weight: 700;
        }

        .order-btn {
            background-color: white;
            color: black;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
        }

        .icons-section {
            background-color: #f5e8d8;
            padding: 30px 0;
            text-align: center;
        }

        .icon-item {
            display: inline-block;
            margin: 0 30px;
            text-align: center;
        }

        .icon-item img {
            width: 50px;
            height: 50px;
        }

        .icon-item p {
            margin-top: 10px;
            font-weight: bold;
        }

        .cover-section {
            position: relative;
            background: url('{{ asset(' images/background.jpg') }}') no-repeat center center/cover;
            height: 90vh;
            display: flex;
            align-items: center;
            padding-left: 10%;
            color: white;
        }

        .cover-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
        }

        .cover-content h2 {
            font-size: 22px;
            font-weight: 300;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .cover-content h1 {
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            max-width: 500px;
        }

        .order-btn {
            background-color: white;
            color: black;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 15px;
            display: inline-block;
        }

        .icons-section {
            background-color: #f5e8d8;
            padding: 40px 0;
        }

        .icon-item {
            text-align: center;
        }

        .icon-item img {
            width: 60px;
            height: 60px;
        }

        .icon-item p {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .hero-bg {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .slide-container {
            position: relative;
            height: 100%;
            width: 100%;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.3);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #fff;
            padding: 2rem;
        }

        .hero-content h2,
        .hero-content h1 {
            font-family: 'Playfair Display', serif;
        }

        .btn-custom {
            background-color: #ff8c00;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #e67e00;
        }

        .card {
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-description-overlay {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            pointer-events: none;
        }

        .card:hover .card-description-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .location-image {
            height: 250px;
            width: 100%;
            object-fit: cover;
        }

        .body {
            background-color: #f5e8d8;
        }

        .caffeine-footer {
            background-color: #d9a372 !important;
            color: #f5e2cc !important;
            padding: 60px 0 20px !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .caffeine-footer-container {
            max-width: 1200px !important;
            margin: 0 auto !important;
            padding: 0 20px !important;
        }

        .caffeine-footer-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
            gap: 30px !important;
            margin-bottom: 40px !important;
        }

        .caffeine-footer-brand {
            display: flex !important;
            flex-direction: column !important;
        }

        .caffeine-footer-heading {
            color: #fff !important;
            font-size: 18px !important;
            font-weight: 600 !important;
            margin-bottom: 20px !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
        }

        .caffeine-footer-text {
            color: #ede0d4 !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
        }

        .caffeine-footer-links {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .caffeine-footer-link {
            color: #ede0d4 !important;
            text-decoration: none !important;
            font-size: 14px !important;
            line-height: 2 !important;
            transition: color 0.3s ease !important;
        }

        .caffeine-footer-link:hover {
            color: #d35400 !important;
            text-decoration: underline !important;
        }

        .caffeine-social-links {
            display: flex !important;
            gap: 15px !important;
        }

        .caffeine-social-icon {
            color: #ede0d4 !important;
            font-size: 20px !important;
            transition: color 0.3s ease !important;
        }

        .caffeine-social-icon:hover {
            color: #d35400 !important;
        }

        .caffeine-footer-bottom {
            border-top: 1px solid rgba(237, 224, 212, 0.2) !important;
            padding-top: 20px !important;
            text-align: center !important;
        }

        .caffeine-copyright {
            color: #ede0d4 !important;
            font-size: 13px !important;
            margin: 0 !important;
        }

        @media (max-width: 768px) {
            .caffeine-footer-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
            }

            .caffeine-footer-heading {
                font-size: 16px !important;
            }
        }

        .caffeine-nav {
            background: linear-gradient(135deg, #f5e8d8 0%, #ede0d4 100%) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            position: fixed !important;
            top: 0 !important;
            width: 100% !important;
            z-index: 1030 !important;
            padding: 15px 0 !important;
            font-family: 'Playfair Display', serif !important;
        }

        .caffeine-nav-container {
            max-width: 1300px !important;
            margin: 0 auto !important;
            padding: 0 30px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }

        .caffeine-nav-brand {
            display: flex !important;
            align-items: center !important;
            text-decoration: none !important;
            transition: transform 0.3s ease !important;
        }

        .caffeine-nav-brand:hover {
            transform: scale(1.05) !important;
        }

        .caffeine-nav-logo {
            width: 50px !important;
            height: 50px !important;
            margin-right: 15px !important;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3)) !important;
        }

        .caffeine-nav-brand-text {
            color: #3d2b23 !important;
            font-size: 28px !important;
            font-weight: 700 !important;
            letter-spacing: 1.5px !important;
            text-transform: uppercase !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2) !important;
        }

        .caffeine-nav-toggler {
            border: none !important;
            background: transparent !important;
            padding: 8px !important;
            display: none !important;
        }

        .caffeine-nav-toggler-icon {
            display: block !important;
            width: 25px !important;
            height: 2px !important;
            background: #3d2b23 !important;
            position: relative !important;
            transition: all 0.3s ease !important;
        }

        .caffeine-nav-toggler-icon::before,
        .caffeine-nav-toggler-icon::after {
            content: '' !important;
            position: absolute !important;
            width: 25px !important;
            height: 2px !important;
            background: #3d2b23 !important;
            transition: all 0.3s ease !important;
        }

        .caffeine-nav-toggler-icon::before {
            top: -8px !important;
        }

        .caffeine-nav-toggler-icon::after {
            bottom: -8px !important;
        }

        .caffeine-nav-content {
            display: flex !important;
            align-items: center !important;
        }

        .caffeine-nav-links {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
        }

        .caffeine-nav-item {
            margin: 0 20px !important;
        }

        .caffeine-nav-link {
            color: #3d2b23 !important;
            font-size: 18px !important;
            font-weight: 400 !important;
            text-decoration: none !important;
            position: relative !important;
            padding-bottom: 5px !important;
            transition: all 0.3s ease !important;
        }

        .caffeine-nav-link::after {
            content: '' !important;
            position: absolute !important;
            width: 0 !important;
            height: 2px !important;
            bottom: 0 !important;
            left: 0 !important;
            background: #d35400 !important;
            transition: width 0.3s ease !important;
        }

        .caffeine-nav-link:hover::after {
            width: 100% !important;
        }

        .caffeine-nav-link:hover {
            color: #d35400 !important;
        }

        .caffeine-nav-actions {
            display: flex !important;
            align-items: center !important;
            margin-left: 30px !important;
        }

        /* Profile Dropdown Styles */
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #d35400;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.1);
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            display: none;
            z-index: 1000;
            min-width: 200px;
        }

        .profile-dropdown.show {
            display: block;
        }

        .profile-dropdown .dropdown-item {
            padding: 8px 15px;
            color: #3d2b23;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.3s ease;
        }

        .profile-dropdown .dropdown-item:hover {
            background-color: #f5e8d8;
            color: #d35400;
        }

        .profile-dropdown .dropdown-item i {
            margin-right: 10px;
        }

        @media (max-width: 992px) {
            .caffeine-nav-toggler {
                display: block !important;
            }

            .caffeine-nav-content {
                position: absolute !important;
                top: 100% !important;
                left: 0 !important;
                width: 100% !important;
                background: #f5e8d8 !important;
                flex-direction: column !important;
                padding: 20px !important;
                display: none !important;
            }

            .caffeine-nav-content.show {
                display: flex !important;
            }

            .caffeine-nav-links {
                flex-direction: column !important;
                width: 100% !important;
            }

            .caffeine-nav-item {
                margin: 10px 0 !important;
                width: 100% !important;
                text-align: center !important;
            }

            .caffeine-nav-actions {
                flex-direction: column !important;
                width: 100% !important;
                margin-left: 0 !important;
            }

            .profile-img {
                margin: 10px 0;
            }

            .profile-dropdown {
                right: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        {{-- <div class="py-3 row align-items-center bg-light px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="px-2 h1 text-uppercase text-primary bg-dark">My</span>
                    <span class="px-2 h1 text-uppercase text-dark bg-primary ml-n1">Shop</span>
                </a>
            </div>
        </div> --}}
    </div>
    <!-- Topbar End -->

    @if (session('status'))
    <div class="text-center alert alert-success alert-dismissible fade show" role="alert"
        style="position: relative; z-index: 1050;">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <!-- Navbar Start -->
    <nav class="shadow-sm navbar navbar-expand-lg fixed-top" style="background: linear-gradient(135deg, #f5e8d8 0%, #ede0d4 100%);">
        <div class="container-fluid px-xl-5">
            <!-- Brand -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="{{ asset('coffee-svgrepo-com.png') }}" alt="Logo" width="50" height="50" class="me-2">
                <span style="color: #3d2b23; font-family: 'Playfair Display', serif; font-size: 28px;">Caffeine Corner</span>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Navigation Links -->
                <ul class="mb-2 navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('user.anotherPage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('user.aboutUs') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('user.menu') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('user.orderMenu') }}">Order</a>
                    </li>
                </ul>

                <!-- Profile Image and Dropdown -->
                <div class="d-flex align-items-center caffeine-nav-actions">
                    <!-- Profile Image -->
                    <div class="position-relative">
                        @if (Auth::user()->profile_photo_path)
                            <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Profile Image" class="profile-img" id="profileImage">
                        @else
                            <img src="{{ asset('images/profile-default-icon-2048x2045-u3j7s5nj.png') }}" alt="Default Profile" class="profile-img" id="profileImage">
                        @endif

                        <!-- Profile Dropdown -->
                        <div class="profile-dropdown" id="profileDropdown">
                            <a href="{{ route('user.account') }}" class="dropdown-item">
                                <i class="fas fa-user"></i> Account
                            </a>
                            <form action="{{ route('logout') }}" method="POST" style="display: contents;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Logout Button (Optional, can remove if using dropdown) -->
                    <form action="{{ route('logout') }}" method="POST" class="ms-3">
                        @csrf
                        <button class="btn btn-danger rounded-pill" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                {{-- <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav> --}}
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Start -->
    @yield('container')

    <!-- Shop End -->

    <!-- Footer -->
    <footer class="caffeine-footer">
        <div class="caffeine-footer-container">
            <div class="caffeine-footer-grid">
                <!-- Brand Section -->
                <div class="caffeine-footer-brand">
                    <h5 class="caffeine-footer-heading">Caffeine Corner</h5>
                    <p class="caffeine-footer-text">Your cozy coffee haven since 2023</p>
                </div>

                <!-- Navigation Section -->
                <div class="caffeine-footer-nav">
                    <h5 class="caffeine-footer-heading">Explore</h5>
                    <ul class="caffeine-footer-links">
                        <li><a href="{{ route('user.anotherPage') }}" class="caffeine-footer-link">Home</a></li>
                        <li><a href="{{ route('user.blogs') }}" class="caffeine-footer-link">Menu</a></li>
                        <li><a href="{{ route('user.menu') }}" class="caffeine-footer-link">Blogs</a></li>
                        <li><a href="{{ route('user.orderMenu') }}" class="caffeine-footer-link">Order</a></li>
                    </ul>
                </div>

                <!-- Info Section -->
                <div class="caffeine-footer-info">
                    <h5 class="caffeine-footer-heading">Company</h5>
                    <ul class="caffeine-footer-links">
                        <li><a href="{{ route('user.aboutUs') }}" class="caffeine-footer-link">About Us</a></li>
                        <li><a href="{{ route('user.aboutUs') }}" class="caffeine-footer-link">Our Story</a></li>
                        {{--  <li><a href="{{ route('user.aboutUs') }}" class="caffeine-footer-link">Contact</a></li>  --}}
                    </ul>
                </div>

                <!-- Social Section -->
                <div class="caffeine-footer-social">
                    <h5 class="caffeine-footer-heading">Connect</h5>
                    <div class="caffeine-social-links">
                        <a href="https://www.facebook.com/profile.php?id=61573564183585&mibextid=ZbWKwL" class="caffeine-social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/corner.caffeine?igsh=MXQyNWowbHBxYm94bQ==" class="caffeine-social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="caffeine-footer-bottom">
                <p class="caffeine-copyright">© 2025 Caffeine Corner. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <a href="#" class="btn back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-JobWAqYk5CSjWuVV3mxgS+MmccJqkrBaDhk8SKS1BW+71dJ9gzascwzW85UwGhxiSyR7Pxhu50k+Nl3+o5I49A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>

    <!-- Owl Carousel JS -->
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript Files -->
    <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('user/mail/contact.js') }}"></script>

    <!-- Main Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // Toggle profile dropdown
            $('#profileImage').click(function(e) {
                e.preventDefault();
                $('#profileDropdown').toggleClass('show');
            });

            // Close dropdown when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('.profile-img').length) {
                    $('#profileDropdown').removeClass('show');
                }
            });
        });
    </script>
    @yield('scriptSource')
</body>

</html>
