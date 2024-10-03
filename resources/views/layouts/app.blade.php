<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>

    @include('layouts.preloader')

    <div id="main-wrapper">

        @include('layouts.nav_header')
        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="content-body">

            <div class="container-fluid mt-3">
                @yield('content')
            </div>
        </div>

        @include('layouts.footer')
    </div>
    @include('layouts.script')

</body>

</html>
