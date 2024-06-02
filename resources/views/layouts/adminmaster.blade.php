<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Creation Soft Nepal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/logo.png')}}">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('fonts/flaticon.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{asset('css/datepicker.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Modernize js -->
    <script src="{{asset('js/modernizr-3.6.0.min.js')}}"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash ">
        <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <a href="{{url('admin/dashboard')}}">
                        <img src="{{asset('logo.png')}}" width="120px" alt="creation-soft-logo">
                    </a>
                </div>
                <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
                <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control" placeholder="Find Something . . .">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title">{{auth()->user()->name}}</h5>
                            </div>
                            <div class="admin-img">
                                <img src="img/figure/admin.jpg" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <div class="item-header">
                                <h6 class="item-title"> {{auth()->user()->name}}</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                                    <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <li><a href="" class="text-black" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="flaticon-turn-off"></i>Logout
                                        </a></li>

                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color " style="height: 89vh;">
                <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="index.html"><img src="img/logo1.png" alt="logo"></a>
                    </div>
                </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item">
                            <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>

                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Home pages</span></a>
                            <ul class="nav sub-group-menu">

                                <li class="nav-item">
                                    <a href="{{url('/admin/hero')}}" class="nav-link"><i class="fas fa-angle-right"></i>Hero Section</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/about')}}" class="nav-link"><i class="fas fa-angle-right"></i>About section</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/services')}}" class="nav-link"><i class="fas fa-angle-right"></i>services section</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/portfolio')}}" class="nav-link"><i class="fas fa-angle-right"></i>portfolio section</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/testimonial')}}" class="nav-link"><i class="fas fa-angle-right"></i>testimonial section</a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Product</span></a>
                            <ul class="nav sub-group-menu sub-group-active">
                                <li class="nav-item">
                                    <a href="products" class="nav-link"><i class="fas fa-angle-right"></i>All Product</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/products')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Product</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-settings"></i><span>Settings</span></a>
                            <ul class="nav sub-group-menu">

                                <li class="nav-item">
                                    <a href="{{url('/admin/users')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add User</a>
                                </li>
                                <li class="nav-item">
                                    
                                    <a href="{{url('/admin/roles')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/permission-categorys')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Permission Group</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/permissions')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Permission</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/testimonial')}}" class="nav-link"><i class="fas fa-angle-right"></i>Site Setting</a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            @yield('content')
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Plugins js -->
    <script src="{{asset('js/plugins.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Scroll Up Js -->
    <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
    <!-- Select 2 Js -->
    <script src="{{asset('js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{asset('js/datepicker.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('js/main.js')}}"></script>
    <!-- tinymce -->
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>

    <script>
        tinymce.init({
            selector: '.tinymce',
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'template', 'codesample'
            ],
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons',
            menu: {
                favs: {
                    title: 'menu',
                    items: 'code visualaid | searchreplace | emoticons'
                }
            },
            menubar: 'favs file edit view insert format tools',
            content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
        });
    </script>


    @yield('scripts')
</body>

</html>