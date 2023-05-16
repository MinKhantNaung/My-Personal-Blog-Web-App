<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Fontawesome Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body class="bg-secondary-subtle">
    <!-- navbar Section -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bolder fs-3" href="index.html">MR.MIN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-between offset-lg-3" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" aria-current="page" href="{{ route('main') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" href="{{ route('portfolio') }}">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" href="{{ route('main') }}#blogs">Blogs</a>
                    </li>
                </ul>
                <ul class="navbar-nav offset-lg-4 my-lg-0 my-2">
                    <li class="nav-item">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">Login</a>
                        @endguest

                        @auth
                            <div class="dropdown">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('images/default.png') }}" role="button" class="rounded-circle"
                                            alt="" style="width:40px; height:40px">
                                    @else
                                        <img src="{{ asset('storage/images/' . Auth::user()->image) }}" role="button" class="rounded-circle img-fluid object-fit-cover"
                                            alt="" style="width:40px; height:40px">
                                    @endif

                                </div>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('users.accoountDetail') }}"><i class="fa-solid fa-user me-1"></i>Account</a></li>
                                    <li><a class="dropdown-item" href="{{ route('users.changePassword') }}"><i class="fa-solid fa-key me-1"></i>Change Password</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">

                                            @csrf
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket me-1"></i>Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </li>
                </ul>
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" aria-current="page" href="#"><i
                                class="fa-brands fa-facebook-f"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" href="#"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" href="#"><i class="fa-brands fa-twitter"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black fw-bold" href="#"><i
                                class="fa-solid fa-magnifying-glass"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Head Section -->
    <section id="head">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid py-2">
                    <a class="navbar-brand fw-bolder" href="{{ route('main') }}#blogs">Blog</a>
                    <a href="{{ route('main') }}#blogs">
                        <button class="float-end btn btn-outline-secondary">
                            <i class="fa-solid fa-plus me-1"></i>Explore My Blogs
                        </button>
                    </a>
                </div>
            </nav>
        </div>
    </section>

    @yield('content')

    <!-- Footer Section -->
    <section id="footer" class="bg-secondary-subtle">
        <div class="container">
            <div class="row text-black">
                <div class="col-md-3 col-sm-6 py-sm-5 py-3"><a href=""
                        class="fw-bolder fs-4 text-decoration-none text-uppercase text-black">Mr.Min</a></div>
                <div class="col-md-3 col-sm-6 py-sm-5 py-3">
                    <h5 class="mb-3">About us</h5>
                    <div class="text-muted">My Team</div>
                    <div class="text-muted">We share</div>
                    <div class="text-muted">We code</div>
                    <div class="text-muted">We care environment</div>
                </div>
                <div class="col-md-3 col-sm-6 py-sm-5 py-3">
                    <h5 class="mb-3">Product</h5>
                    <div class="text-muted">Main Sponser</div>
                    <div class="text-muted">Aung Bann</div>
                    <div class="text-muted">Transportation</div>
                    <div class="text-muted">Shopify</div>
                </div>
                <div class="col-md-3 col-sm-6 py-sm-5 py-3">
                    <h5 class="mb-3">Contact Us</h5>
                    <div class="text-muted">hello@minnaungweb.com</div>
                    <div class="text-muted">+95 -258138866</div>
                    <div class="mt-1">
                        <a href="" class="pe-3 text-black"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="" class="pe-3 text-black"><i class="fa-brands fa-instagram"></i></a>
                        <a href="" class="pe-3 text-black"><i class="fa-brands fa-telegram"></i></a>
                        <a href="" class="pe-3 text-black"><i class="fa-brands fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sub-footer section -->
    <section class="bg-white">
        <div class="container">
            <div class="row py-4">
                <div class="col-12 d-flex justify-content-between">
                    <div class="text-muted">&copy; 2022 Energitic Themes</div>
                    <div class="text-muted">
                        <span>Privacy Policy</span>
                        <span>Terms & Conditions</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<!-- Jquery Js -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Fontawesome Js -->
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<!-- Bootstrap Js -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

@yield('script')

</html>
