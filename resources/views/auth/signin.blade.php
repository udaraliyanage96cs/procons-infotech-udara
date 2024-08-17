<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Procons Infotech</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('../../assets/vendor/fonts/boxicons.css') }} " />

    <link rel="stylesheet" href="{{ asset('../../assets/vendor/fonts/fontawesome.css') }} " />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/fonts/flag-icons.css') }} " />

    <link rel="stylesheet" href="{{ asset('../../assets/vendor/css/rtl/core.css') }} "
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/css/rtl/theme-default.css') }} "
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('../../assets/css/demo.css') }} " />

    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} " />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/typeahead-js/typeahead.css') }} " />
    <link rel="stylesheet"
        href="{{ asset('../../assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }} " />


    <link rel="stylesheet" href="{{ asset('../../assets/vendor/css/pages/page-auth.css') }} " />

    <script src="{{ asset('../../assets/vendor/js/helpers.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/js/template-customizer.js') }} "></script>
    <script src="{{ asset('../../assets/js/config.js') }} "></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
                <div class="flex-row text-center mx-auto">
                    <img src="{{ asset('../../assets/img/pages/login-light.png') }} " alt="Auth Cover Bg color"
                        width="520" class="img-fluid authentication-cover-img"
                        data-app-light-img="pages/login-light.png" data-app-dark-img="pages/login-dark.png" />
                    <div class="mx-auto">
                        <h3>Discover the powerful admin template 🥳</h3>
                        <p>
                            Perfectly suited for all level of developers which helps you to <br />
                            kick start your next big projects & Applications.
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Left Text -->
            
            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    @if ($errors->any())
                        @if(implode('', $errors->all(':message')) == 'not-verified')
                            <div class="bs-toast toast fade show mb-4 w-100" role="alert" aria-live="assertive" aria-atomic="true"
                                id="success-alert">
                                <div class="toast-header bg-danger">
                                    <div class="me-auto fw-semibold">Alerts</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">Please Verify Your Email Address</div>
                            </div>
                        @elseif(implode('', $errors->all(':message')) == 'faild')
                            <div class="bs-toast toast fade show mb-4 w-100" role="alert" aria-live="assertive" aria-atomic="true"
                                id="success-alert">
                                <div class="toast-header bg-danger">
                                    <div class="me-auto fw-semibold">Alerts</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">Email or Password is Incorrect. Please Try Again With Correct Login Details</div>
                            </div>
                        @endif
                    @endif

                    <div class="app-brand mb-4">
                        <a href="/" class="app-brand-link gap-2 mb-2">
                            <span class="app-brand-text demo h3 mb-0 fw-bold">Procons Infotech</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome to Procons Infotech! 👋</h4>
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>

                    <form id="formAuthentication" class="mb-3" action="/signin" method="POST">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your Email Address" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <a href="/forgotpassword">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                    </form>
                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="/signup">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Vendors JS -->


    <script src="{{ asset('../../assets/js/main.js') }}"></script>
    <script src="{{ asset('../../assets/js/pages-auth.js') }} "></script>

    <script src="{{ asset('../../assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/libs/popper/popper.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/js/bootstrap.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }} "></script>

    <script src="{{ asset('../../assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('../../assets/vendor/libs/i18n/i18n.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/libs/typeahead-js/typeahead.js') }} "></script>

    <script src="{{ asset('../../assets/vendor/js/menu.js') }} "></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('../../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }} "></script>
</body>

</html>
