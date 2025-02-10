<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="py-3 row align-items-center bg-light px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="px-2 h1 text-uppercase text-primary bg-dark">My</span>
                    <span class="px-2 h1 text-uppercase text-dark bg-primary ml-n1">Shop</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    @if (session('status'))
    <div class="text-center alert alert-success alert-dismissible fade show" role="alert" style="position: relative; z-index: 1050;">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-9">
                <nav class="py-3 rounded navbar navbar-expand-lg navbar-dark bg-dark px-lg-4">
                    <!-- Brand for mobile view -->
                    <a href="#" class="mb-2 text-decoration-none d-block d-lg-none">
                        <span class="px-2 h1 text-uppercase text-dark bg-light rounded-left">Multi</span>
                        <span class="px-2 h1 text-uppercase text-light bg-primary rounded-right ml-n1">Shop</span>
                    </a>

                    <!-- Toggler for responsive menu -->
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navbar items -->
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="mr-auto navbar-nav">
                            <a href="{{ route('user.home') }}" class="px-3 nav-item nav-link active text-uppercase">Home</a>
                            <a href="cart.html" class="px-3 nav-item nav-link text-uppercase">My Cart</a>

                            <!-- Dropdown Menu for Categories -->
                            <a href="contact.html" class="px-3 nav-item nav-link text-uppercase">Contact</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="px-3 nav-link dropdown-toggle text-uppercase" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-weight-bold text-light">{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.changePassword') }}">Change Password</a>
                                    <a class="dropdown-item" href="{{ route('user.account') }}">Account</a>
                                </div>
                            </div>

                        </div>

                        <!-- Right-side icons and user details -->
                        <div class="ml-auto navbar-nav d-none d-lg-flex align-items-center">


                            <!-- Logout Button -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="ml-3 btn btn-primary" type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                {{--  <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>  --}}
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
 @yield('container')

    <!-- Shop End -->


    <!-- Footer Start -->
    <div class="pt-5 mt-5 container-fluid bg-dark text-secondary">
        <div class="pt-5 row px-xl-5">
            <div class="pr-3 mb-5 col-lg-4 col-md-12 pr-xl-5">
                <h5 class="mb-4 text-secondary text-uppercase">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="mr-3 fa fa-map-marker-alt text-primary"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="mr-3 fa fa-envelope text-primary"></i>info@example.com</p>
                <p class="mb-0"><i class="mr-3 fa fa-phone-alt text-primary"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="mb-5 col-md-4">
                        <h5 class="mb-4 text-secondary text-uppercase">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Home</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Our Shop</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shop Detail</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shopping Cart</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="mb-5 col-md-4">
                        <h5 class="mb-4 text-secondary text-uppercase">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Home</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Our Shop</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shop Detail</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shopping Cart</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="mb-5 col-md-4">
                        <h5 class="mb-4 text-secondary text-uppercase">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="mt-4 mb-3 text-secondary text-uppercase">Follow Us</h6>
                        <div class="d-flex">
                            <a class="mr-2 btn btn-primary btn-square" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="mr-2 btn btn-primary btn-square" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="mr-2 btn btn-primary btn-square" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4 row border-top mx-xl-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="text-center mb-md-0 text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="text-center col-md-6 px-xl-0 text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-JobWAqYk5CSjWuVV3mxgS+MmccJqkrBaDhk8SKS1BW+71dJ9gzascwzW85UwGhxiSyR7Pxhu50k+Nl3+o5I49A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

</body>
@yield('scriptSource')
</html>
