<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; SiKasir</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
    <!-- Start GA -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script> --}}
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
<!-- /END GA --></head>

<body>
    <div id="app">
        <section class="section">
        <div class="container mt-5">
            <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    @php
                        $img = DB::table('settings')->first();
                    @endphp
                    <img src="{{asset('/image/'.$img->logo)}}" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                <div class="card-header"><h4>Login</h4></div>

                <div class="card-body">
                    
                    <form class="needs-validation" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                            <div class="invalid-feedback">
                                Please fill in your email
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                                <div class="float-right">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 text-small" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                            <div class="invalid-feedback">
                                please fill in your password
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                </div>
                <div class="simple-footer">
                Copyright &copy; Stisla 2018
                </div>
            </div>
            </div>
        </div>
        </section>
    </div>

    <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('assets/modules/popper.js')}}"></script>
    <script src="{{asset('assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>
    
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
