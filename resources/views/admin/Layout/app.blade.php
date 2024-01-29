<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AZ media</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <script src="https://kit.fontawesome.com/183280f8d9.js" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">

                <span class="brand-text font-weight-light">My Media App </span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{route('admin#profile')}}" class="nav-link">
                                <button class="btn" style="color: #c2c7d0">
                                    <i class="fas fa-user-circle"></i>
                                    <p class="">
                                        Profile
                                    </p>
                                </button>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin#list')}}" class="nav-link">
                                <button class="btn" style="color: #c2c7d0">
                                    <i class="fas fa-users"></i>
                                    <p>
                                        Admin List
                                    </p>
                                </button>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin#categoryList')}}" class="nav-link">
                                <button class="btn" style="color: #c2c7d0">
                                    <i class="fas fa-list"></i>
                                    <p>
                                        Category
                                    </p>
                                </button>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin#postList')}}" class="nav-link">
                                <button class="btn" style="color: #c2c7d0">
                                    <i class="fa-brands fa-usps"></i>
                                    <p>
                                        Posts
                                    </p>
                                </button>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin#trendPost')}}" class="nav-link">
                                <button class="btn" style="color: #c2c7d0">
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    <p>
                                        Trend Posts
                                    </p>
                                </button>
                            </a>
                        </li>

                        <li class="nav-item mt-3">

                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Logout
                                    </button>
                                </form>

                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('myContent')
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
</body>

</html>
