<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="az7I-z_2CG54yy7MP5sj5-RrF2N4m5ifgWMykiyriE4" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ('Smart Business Solutions') }}</title>
    <!-- icon -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fa/css/all.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owlcarousel/assets/owl.carousel.min.css') }}">
    <!-- this template -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Jquery -->
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
</head>

<body>
    <div id="app">

        @if(Request::is(['login', 'register', 'password/*']))

        <div class="container-fluid center-content">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-5">
                        <div class="card border-0 shadow px-2">
                            <div class="card-header bg-transparent text-capitalize border-0 pb-0 text-center">

                                <img src="{{ asset('logo.png') }}" alt="logo" class="mb-2" style="max-height: 100px; max-width: 100px;">

                                <h4 class="m-0">
                                    @if (Str::startsWith(Request::path(), 'password/'))
                                    {{ 'reset password' }}
                                    @elseif (Request::path() === 'verify')
                                    {{ 'Verify Your Email Address' }}
                                    @else
                                    {{ Request::path() }}
                                    @endif
                                </h4>

                            </div>
                            <div class="card-body">

                                @yield('content')

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @else

        <!-- Topbar Start -->
        <div class="container-fluid">
            <div class="row bg-secondary py-2 px-xl-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark" href="">FAQs</a>
                        <span class="text-muted px-2">|</span>
                        <a class="text-dark" href="">Help</a>
                        <span class="text-muted px-2">|</span>
                        <a class="text-dark" href="">Support</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark px-2" href="">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a class="text-dark pl-2" href="">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center py-3 px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a href="/" class="text-decoration-none">
                        <img src="{{ asset('logo.png') }}" alt="" style="max-height: 80px; max-width: 80px;">
                    </a>
                </div>
                <div class="col-lg-6 col-6 text-left">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for products" />
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-6 text-right">
                    <a href="" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                    <a href="" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar Start -->
        <div class="container-fluid mb-5">
            @if(Request::is('/'))
            <div class="row border-top px-xl-5">
                @else
                <div class="row border-top shadow-sm px-xl-5">
                    @endif

                    <div class="col-lg-3 d-none d-lg-block">
                        <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px">
                            <h6 class="m-0 text-white">Categories</h6>
                            <i class="fas fa-angle-down"></i>
                        </a>

                        @if(Request::is('/'))
                        <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                            @else
                            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                                @endif

                                <div class="navbar-nav w-100 overflow-hidden text-capitalize" style="height: 410px">
                                    @foreach ($menu as $category)
                                    @if(count($category['sub_categories'])>0)
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link" data-toggle="dropdown">{{ $category['name'] }}
                                            <i class="fas fa-angle-down float-right mt-1"></i>
                                        </a>
                                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                            @foreach ($category['sub_categories'] as $sub_cat)
                                            <a href="" class="dropdown-item">{{ $sub_cat['sub_category_name'] }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @else
                                    <a href="" class="nav-item nav-link">{{ $category['name'] }}</a>
                                    @endif
                                    @endforeach
                                </div>
                            </nav>

                    </div>

                    <div class="col-lg-9">
                        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                            <a href="/" class="text-decoration-none d-block d-lg-none">
                                <img src="{{ asset('logo.png') }}" alt="" style="max-height: 80px; max-width: 80px;">
                            </a>
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                                <div class="navbar-nav mr-auto py-0">
                                    <a href="/" class="nav-item nav-link active">Home</a>
                                    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                                </div>

                                @if (Route::has('login'))
                                <div class="navbar-nav ml-auto py-0">
                                    @auth
                                    <a href="{{ url('/dashboard') }}" class="nav-item nav-link btn btn-primary text-white">
                                        <i class="fas fa-user"></i> My Account
                                    </a>
                                    @else
                                    <a href="{{ route('login') }}" class="nav-item nav-link">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-item nav-link">
                                        Register
                                    </a>
                                    @endif
                                    @endauth
                                </div>
                                @endif

                            </div>
                        </nav>

                        @if(Request::is('/'))
                        <!-- Display only on home page -->
                        <div id="header-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" style="height: 410px">
                                    <img class="img-fluid" src="{{ asset('assets/images/slides/carousel-1.jpg') }}" alt="Image" />
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                                10% Off Your First Order
                                            </h4>
                                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                                Fashionable Dress
                                            </h3>
                                            <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" style="height: 410px">
                                    <img class="img-fluid" src="{{ asset('assets/images/slides/carousel-2.jpg') }}" alt="Image" />
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                                10% Off Your First Order
                                            </h4>
                                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                                Reasonable Price
                                            </h3>
                                            <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                                <div class="btn btn-dark" style="width: 45px; height: 45px">
                                    <span class="carousel-control-prev-icon mb-n2"></span>
                                </div>
                            </a>
                            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                                <div class="btn btn-dark" style="width: 45px; height: 45px">
                                    <span class="carousel-control-next-icon mb-n2"></span>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Navbar End -->

            <!-- main body start -->
            @yield('content')
            <!-- main body end -->

            <!-- Footer Start -->
            <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
                <div class="row px-xl-5 pt-5">
                    <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                        <p>
                            Smart Business Solutions is dedicated at enhancing continous sale of its vendors who operates under us, we ensure timely invoicing and delivery.
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-map text-primary mr-3"></i>Nairobi - Kenya
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-envelope text-primary mr-3"></i>info@smartsolution.com
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-phone text-primary mr-3"></i>
                        </p>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-4 mb-5">
                                <h5 class="font-weight-bold text-dark mb-4">
                                    Quick Links
                                </h5>
                                <div class="d-flex flex-column justify-content-start">
                                    <a class="text-dark mb-2" href="index.html"><i class="fas fa-angle-right mr-2"></i>Home</a>
                                    <a class="text-dark mb-2" href="shop.html"><i class="fas fa-angle-right mr-2"></i>Our
                                        Shop</a>
                                    <a class="text-dark mb-2" href="detail.html"><i class="fas fa-angle-right mr-2"></i>Shop
                                        Detail</a>
                                    <a class="text-dark mb-2" href="cart.html"><i class="fas fa-angle-right mr-2"></i>Shopping Cart</a>
                                    <a class="text-dark mb-2" href="checkout.html"><i class="fas fa-angle-right mr-2"></i>Checkout</a>
                                    <a class="text-dark" href="contact.html"><i class="fas fa-angle-right mr-2"></i>Contact Us</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <h5 class="font-weight-bold text-dark mb-4">
                                    Quick Links
                                </h5>
                                <div class="d-flex flex-column justify-content-start">
                                    <a class="text-dark mb-2" href="index.html"><i class="fas fa-angle-right mr-2"></i>Home</a>
                                    <a class="text-dark mb-2" href="shop.html"><i class="fas fa-angle-right mr-2"></i>Our
                                        Shop</a>
                                    <a class="text-dark mb-2" href="detail.html"><i class="fas fa-angle-right mr-2"></i>Shop
                                        Detail</a>
                                    <a class="text-dark mb-2" href="cart.html"><i class="fas fa-angle-right mr-2"></i>Shopping Cart</a>
                                    <a class="text-dark mb-2" href="checkout.html"><i class="fas fa-angle-right mr-2"></i>Checkout</a>
                                    <a class="text-dark" href="contact.html"><i class="fas fa-angle-right mr-2"></i>Contact Us</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <h5 class="font-weight-bold text-dark mb-4">
                                    Newsletter
                                </h5>
                                <form action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control border-0 py-4" placeholder="Your Email" required="required" />
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-block border-0 py-3" type="submit">
                                            Subscribe Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border-top border-light mx-xl-5 py-4">
                    <div class="col-md-6 px-xl-0">
                        <p class="mb-md-0 text-center text-md-left text-dark">
                            &copy;
                            <a class="text-dark font-weight-semi-bold" href="#">Smart Business Solutions</a>. All Rights Reserved. Designed by
                            <a class="text-dark font-weight-semi-bold" href="https://dijisoftwares.com/">Dijisoftwares Counsaltancies</a>
                        </p>
                    </div>
                    <div class="col-md-6 px-xl-0 text-center text-md-right">
                        <img class="img-fluid" src="{{ asset('assets/images/others/payments.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <!-- Footer End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-primary back-to-top"><i class="fas fa-angle-double-up"></i></a>

            @endif

        </div>

        <!-- REQUIRED SCRIPTS -->
        <!-- jquery -->
        <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
        <!-- botstrap -->
        <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/popper.min.js') }}"></script>
        <!-- validation -->
        <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
        <!-- datatables -->
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <!-- sweet alert -->
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
        <script src="{{ asset('assets/libs/owlcarousel/owl.carousel.min.js') }}"></script>
        <!-- text-editor -->
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <!-- script -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <!-- scroll spy -->
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                confirmButtonText: 'OK'
            });
        </script>
        @endif
        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session("error") }}',
                confirmButtonText: 'OK'
            });
        </script>
        @endif

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>

        @stack('script')
</body>

</html>