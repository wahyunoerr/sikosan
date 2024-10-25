<!DOCTYPE html>
<html lang="en">

@include('layouts.landing.head')

<body>
    @include('sweetalert::alert')

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar start -->
    @include('layouts.landing.navbar')
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    @include('layouts.landing.modal-search')
    <!-- Modal Search End -->

    <!-- Single Page Header start -->
    @yield('breadcrumb')
    <!-- Single Page Header End -->

    <!-- Fruits Shop Start-->
    @yield('content')
    <!-- Fruits Shop End-->

    <!-- Footer Start -->
    @include('layouts.landing.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    @include('layouts.landing.script')
</body>

</html>
