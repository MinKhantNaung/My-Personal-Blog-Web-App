<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <!-- Fontawesome Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>
    <!-- navbar Section -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"
                aria-controls="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="flex-fill">
                <div class="dropdown float-end">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->image == null)
                            <img src="{{ asset('images/default.png') }}" role="button" class="rounded-circle"
                                alt="" style="width:40px; height:40px">
                        @else
                            <img src="{{ asset('storage/images/' . Auth::user()->image) }}" role="button"
                                class="rounded-circle img-fluid object-fit-cover" alt=""
                                style="width:40px; height:40px">
                        @endif

                    </div>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('admin.detail') }}"><i
                                    class="fa-solid fa-user me-1"></i>Account</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.changePassword') }}"><i
                                    class="fa-solid fa-key me-1"></i>Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">

                                @csrf
                                <button type="submit" class="dropdown-item"
                                    onclick="return confirm('Are you sure you want to logout?')"><i
                                        class="fa-solid fa-right-from-bracket me-1"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <a class="navbar-brand fw-bolder fs-3 text-center" href="{{ route('admin.dashboard') }}">ADMIN DASHBOARD</a>
        </div>
    </nav>
    {{-- Offcanvas Section --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvas"
                        aria-labelledby="offcanvasLabel">
                        <div class="offcanvas-header bg-dark">
                            <h5 class="offcanvas-title" id="offcanvasLabel">Categories</h5>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body bg-dark">
                            <ul class="list-group">
                                <a href="{{ route('posts.index') }}">
                                    <li class="list-group-item bg-dark text-white">POSTS</li>
                                </a>
                                <a href="{{ route('projects.index') }}">
                                    <li class="list-group-item bg-dark text-white">Projects</li>
                                </a>
                                <a href="{{ route('students') }}">
                                    <li class="list-group-item bg-dark text-white">Students</li>
                                </a>
                                <a href="{{ route('skills.index') }}">
                                    <li class="list-group-item bg-dark text-white">Skills</li>
                                </a>
                                <a href="{{ route('images.index') }}">
                                    <li class="list-group-item bg-dark text-white">Images</li>
                                </a>
                                <a href="{{ route('categories.index') }}">
                                    <li class="list-group-item bg-dark text-white">Categories</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        @yield('content')
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
