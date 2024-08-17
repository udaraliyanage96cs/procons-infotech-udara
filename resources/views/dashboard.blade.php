<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed dark-style" dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Procons Infotech</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('../../assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/fonts/boxicons.css') }} " />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/fonts/fontawesome.css') }} " />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/fonts/flag-icons.css') }} " />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/css/rtl/core.css') }} "
        class="template-customizer-core-css" />


    <link rel="stylesheet" href="{{ asset('../../assets/vendor/css/rtl/theme-default.css') }} "
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('../../assets/css/demo.css') }} " />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} " />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/typeahead-js/typeahead.css') }} " />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/apex-charts/apex-charts.css') }} " />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/css/pages/page-misc.css') }} " />
    <!-- Helpers -->
    <script src="{{ asset('../../assets/vendor/js/helpers.js') }} "></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('../../assets/js/config.js') }} "></script>
</head>


<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bold ms-2">PROCONS</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
                        <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-divider mt-0"></div>

                <div class="menu-inner-shadow"></div>


            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="container-fluid">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <!-- Search -->
                            <div class="navbar-nav align-items-center">
                                <div class="nav-item navbar-search-wrapper mb-0">
                                    <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">

                                    </a>
                                </div>
                            </div>
                            <!-- /Search -->

                            <ul class="navbar-nav flex-row align-items-center ms-auto">

                                <!-- User -->

                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <div class="avatar avatar-boarder avatar-online">
                                            <img src="{{ asset('/assets/img/avatars/1-1-default.png') }}" alt
                                                class="rounded-circle" />
                                        </div>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-boarder avatar-online">
                                                            <img src="{{ asset('/assets/img/avatars/1-1-default.png') }}"
                                                                alt class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        @auth
                                                            <span
                                                                class="fw-semibold d-block lh-1">{{ Auth::User()->name }}</span>
                                                            <span
                                                                class="fw-semibold d-block lh-1 mt-1">{{ Auth::User()->email }}</span>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/signout">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Log Out</span>
                                            </a>

                                        </li>
                                    </ul>
                                </li>

                                <!--/ User -->
                            </ul>
                        </div>

                        <!-- Search Small Screens -->
                        <div class="navbar-search-wrapper search-input-wrapper d-none">
                            <input type="text" class="form-control search-input container-fluid border-0"
                                placeholder="Search..." aria-label="Search..." />
                            <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
                        </div>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrappersp">



                </div>
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="">
                        @if (isset($page))
                        @endif
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->

                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://udarax.me" target="_blank"
                                    class="footer-link fw-semibold">UDARAX</a>
                            </div>
                        </div>
                    </footer>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
                        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script>
                        $("#success-alert").fadeTo(5000, 500).slideUp(500, function() {
                            $("#success-alert").slideUp(500);
                        });
                    </script>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    <script src="{{ asset(' ../../assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/libs/popper/popper.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/js/bootstrap.js') }} "></script>
    <script src="{{ asset('../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }} "></script>

    <script src="{{ asset(' ../../assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('../../assets/vendor/libs/typeahead-js/typeahead.js') }} "></script>

    <script src="{{ asset('../../assets/vendor/js/menu.js') }} "></script>

    <script src="{{ asset('../../assets/js/main.js') }}"></script>




</body>

</html>
