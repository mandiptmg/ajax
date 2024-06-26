<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Creation Soft Nepal Pvt. Ltd.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
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
                                <h6 class="item-title mt-1 text-info"> {{ auth()->user()->roles->first()->name ?? 'No Role Assigned' }}</h6>
                            </div>
                            <div class="admin-img ">
                                <img src="{{asset('img/figure/user.png')}}" style="height: 35px; width: 35px  " alt="Admin">
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
                                    <li><a href="{{url('/admin/users')}}"><i class="flaticon-gear-loading"></i>Account Settings</a></li>

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
                        <a href="{{url('admin/dashboard')}}"><img src="img/logo1.png" alt="logo"></a>
                    </div>
                </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item">
                            <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>

                        </li>
                        <li class="nav-item">
                            @can([
                            'create site setting'
                            ])
                            <a href="{{url('/admin/sitesetting')}}" class="nav-link"><i class="fa fa-cog"></i><span>Site Setting</span></a>
                            @endcan
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Home title</span></a>
                            <ul class="nav sub-group-menu">

                                <li class="nav-item">
                                    @canany(['create service'])
                                    <a href="{{url('/admin/servicetitle')}}" class="nav-link"><i class="fas fa-angle-right"></i>services section</a>
                                    @endcanany
                                </li>
                                <li class="nav-item">
                                    @canany([ 'create portfolio'])
                                    <a href="{{url('/admin/portfoliotitle')}}" class="nav-link"><i class="fas fa-angle-right"></i>portfolio section</a>

                                    @endcanany
                                </li>
                                <li class="nav-item">
                                    @canany(['create testimonial'])

                                    <a href="{{url('/admin/testimonialtitle')}}" class="nav-link"><i class="fas fa-angle-right"></i>testimonial section</a>

                                    @endcanany
                                </li>
                                <li class="nav-item"> @canany([
                                    'create product',

                                    ])
                                    <a href="{{url('/admin/producttittle')}}" class="nav-link"><i class="fas fa-angle-right"></i><span>Product section</span></a>
                                    @endcanany

                                </li>

                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Home pages</span></a>
                            <ul class="nav sub-group-menu">

                                <li class="nav-item">
                                    @can(['create hero'])

                                    <a href="{{url('/admin/hero')}}" class="nav-link"><i class="fas fa-angle-right"></i>Hero Section</a>

                                    @endcan
                                </li>
                                <li class="nav-item">
                                    @can(['create about'])

                                    <a href="{{url('/admin/about')}}" class="nav-link"><i class="fas fa-angle-right"></i>About section</a>

                                    @endcan
                                </li>
                                <li class="nav-item">
                                    @canany([ 'view service','create service','update service','delete service'])
                                    <a href="{{url('/admin/services')}}" class="nav-link"><i class="fas fa-angle-right"></i>services section</a>
                                    @endcanany
                                </li>
                                <li class="nav-item">
                                    @canany([ 'view portfolio','create portfolio','update portfolio','delete portfolio'])
                                    <a href="{{url('/admin/portfolio')}}" class="nav-link"><i class="fas fa-angle-right"></i>portfolio section</a>

                                    @endcanany
                                </li>
                                <li class="nav-item">
                                    @canany([ 'view testimonial','create testimonial','update testimonial','delete testimonial'])

                                    <a href="{{url('/admin/testimonial')}}" class="nav-link"><i class="fas fa-angle-right"></i>testimonial section</a>

                                    @endcanany
                                </li>



                            </ul>
                        </li>
                        <li class="nav-item"> @canany([
                            'create product',
                            'view product',
                            'update product',
                            'delete product',
                            ])
                            <a href="{{url('/admin/products')}}" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Product</span></a>
                            @endcanany

                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-settings"></i><span>Settings</span></a>
                            <ul class="nav sub-group-menu">

                                <li class="nav-item">
                                    <a href="{{url('/admin/users')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add User</a>
                                </li>
                                @canany (['view role', 'create role', 'update role', 'delete role'])
                                <li class="nav-item">

                                    <a href="{{url('/admin/roles')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Roles</a>
                                </li>
                                @endcanany
                                <li class="nav-item">
                                    @canany (['view permission category', 'create permission category', 'update permission category', 'delete permission category'])

                                    <a href="{{url('/admin/permission-categorys')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Permission Group</a>

                                    @endcanany
                                </li>
                                <li class="nav-item">
                                    @canany (['view permission', 'create permission', 'update permission', 'delete permission'])

                                    <a href="{{url('/admin/permissions')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Permission</a>

                                    @endcanany
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item"> @canany([
                            'create policy',
                            'view policy',
                            'update policy',
                            'delete policy',
                            ])
                            <a href="{{url('/admin/policy')}}" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Policy</span></a>
                            @endcanany

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
            license_key: 'gpl',
            plugins: [
                "lists"

            ],
            toolbar: "bullist numlist",
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