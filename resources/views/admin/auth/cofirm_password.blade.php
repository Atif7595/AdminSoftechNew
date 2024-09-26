<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Velonic - Bootstrap 5 Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{  asset('assets/images/favicon.ico')}}">

    <!-- Theme Config Js -->
    <script src="{{  asset('assets/js/config.js')}}"></script>

    <!-- App css -->
    <link href="{{  asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{  asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="{{  asset('assets/images/auth-img.jpg')}}" alt="" class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4">
                                        <a href="index.html" class="logo-light">
                                            <img src="assets/images/logo.png" alt="logo" height="22">
                                        </a>
                                        <a href="index.html" class="logo-dark">
                                            <img src="{{  asset('assets/images/logo-dark.png')}}" alt="dark logo" height="22">
                                        </a>
                                    </div>
                                    @if(Session::has('error'))
                                    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <strong> </strong>{{ Session::get('error') }}
                                    </div>
                                    @endif

                                    <div class="p-4 my-auto">
                                        <div class="text-center w-75 m-auto">
                                            <img src="{{  asset('assets/images/users/avatar-1.jpg')}}" height="64" alt="user-image"
                                                class="rounded-circle img-fluid img-thumbnail avatar-xl">
                                            <h4 class="text-center mt-3 fw-bold fs-20">Hi ! {{ $user->nom }} </h4>
                                            <p class="text-muted mb-4">Enter your Code to access the admin.</p>
                                        </div>

                                        <!-- form -->
                                        <form action="{{ route('confirmCode.code') }}" id="verification-form">
                                            <input type="hidden" name="ic" value="{{ $user->id }}">
                                            <div class="mb-3 verification-code" style="display: flex; gap: 23px; align-items: center;">
                                                <input type="text" maxlength="1" class="form-control" name="code[]" required style="width: 40px; text-align: center;">
                                                <input type="text" maxlength="1" class="form-control" name="code[]" required style="width: 40px; text-align: center;">
                                                <input type="text" maxlength="1" class="form-control" name="code[]" required style="width: 40px; text-align: center;">
                                                <input type="text" maxlength="1" class="form-control" name="code[]" required style="width: 40px; text-align: center;">
                                                <input type="text" maxlength="1" class="form-control" name="code[]" required style="width: 40px; text-align: center;">
                                                <input type="text" maxlength="1" class="form-control" name="code[]" required style="width: 40px; text-align: center;">

                                            </div>
                                            @error('code')
                                                <div class="alert alert-danger alert-dismissible mt-3" role="alert">
                                                    {{ $errors->first('code') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror

                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>
{{--
                                            <div class="text-center mt-4">
                                                <p class="text-muted fs-16">Sign in with</p>
                                                <div class="d-flex gap-2 justify-content-center mt-3">
                                                    <a href="javascript: void(0);" class="btn btn-soft-primary"><i
                                                            class="ri-facebook-circle-fill"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-soft-danger"><i
                                                            class="ri-google-fill"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-soft-info"><i
                                                            class="ri-twitter-fill"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-soft-dark"><i
                                                            class="ri-github-fill"></i></a>
                                                </div>
                                            </div> --}}
                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Back To <a href="auth-login.html"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a></p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>document.write(new Date().getFullYear())</script> © Velonic - Theme by Techzaa
        </span>
    </footer>
    <script src="{{  asset('assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{  asset('assets/js/app.min.js')}}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.verification-code input').on('input', function() {
                if ($(this).val().length == 1) {
                    $(this).next(':input').focus();
                }
                if ($('.verification-code input').filter(function() { return $(this).val() === ''; }).length === 0) {
                // Submit the form when all inputs are filled
                $('#verification-form').submit();
            }
            });
        });
    </script>

</body>

</html>
