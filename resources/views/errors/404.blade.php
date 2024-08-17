<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>
  <x-utils.header/>
</head>

<body>
    <div class="container-p-y" style="height: 100vh;">
        <div class="misc-wrapper">
            <h1 class="mb-2 mx-2">Page Not Found :(</h1>
            <p class="mb-4 mx-2">We couldn't find the page you are looking for</p>
            <a href="/" class="btn btn-primary">Back to home</a>
            <div class="mt-3">
                <img src="{{ asset(' ../../assets/img/illustrations/page-misc-error-light.png') }}"
                    alt="page-misc-error-light" width="500" class="img-fluid"
                    data-app-light-img="illustrations/page-misc-error-light.png"
                    data-app-dark-img="illustrations/page-misc-error-dark.png" />
            </div>
        </div>
    </div>

    <x-utils.footer/>
    
</body>

</html>
