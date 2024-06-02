<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Creation Soft Nepal | login</title>
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
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">

    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('fonts/flaticon.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Modernize js -->
    <script src="{{asset('js/modernizr-3.6.0.min.js')}}"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Login Page Start Here -->
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box bg-dark ">
                <div class="item-logo">
                    <img src="{{asset('/logo.png')}}" alt="logo">
                </div>
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="form-group text-white">
                        <label class="text-white">{{ __('Email Address') }}</label>
                        <input type="email" placeholder="Enter username" class="form-control  @error('email') is-invalid @enderror text-white" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <i class="far fa-envelope"></i>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group text-white">
                        <label class="text-white">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control text-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <i class="fas fa-lock"></i>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group text-white d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label text-white" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                    </div>
                    <div class="form-group text-white">
                        <button type="submit" class="login-btn">    {{ __('Login') }}</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <!-- Login Page End Here -->
    <div>
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
        <!-- Custom Js -->
        <script src="{{asset('js/main.js')}}"></script>
        <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    @yield('tinymce') -->
    </div>


</body>


</html>