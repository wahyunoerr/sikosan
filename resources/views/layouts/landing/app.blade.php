<!DOCTYPE html>
<html lang="en">
@include('layouts.landing.head')

<body>

    <div class="boxed_wrapper">

        <div class="preloader"></div>
        @include('layouts.landing.header')
        @include('layouts.landing.mobile-menu')
        @yield('content')

        @include('layouts.landing.footer')

        @include('layouts.landing.script')

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="far fa-long-arrow-up"></span>
        </button>
    </div>
</body>

</html>
