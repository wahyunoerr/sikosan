<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                    <a href="#" class="text-white">Riau, Indonesia</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">sikosan@gmail.com</a></small>
            </div>
            @guest
                <div class="top-link pe-2">
                    <a href="{{ route('login') }}" class="text-white"><small class="text-white mx-2">Log In</small>/</a>
                    <a href="{{ route('register') }}" class="text-white"><small class="text-white ms-2">Register</small></a>
                </div>
            @else
                <div class="top-link pe-2">
                    @role('admin')
                        <a href="{{ route('home') }}" class="text-white"><small class="text-white mx-2">Back To
                                Dashboard<i class="bi bi-box-arrow-in-right ms-2"></i></small></a>
                    @endrole
                    @role('customer')
                        <a href="{{ route('booking.customer') }}" class="text-white"><small class="text-white mx-2">My Booking
                                List</small>/</a>
                        <a href="{{ route('logout') }}" class="text-white"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><small
                                class="text-white ms-2">Log Out</small><i class="bi bi-box-arrow-right ms-2"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post">@csrf</form>
                    @endrole
                </div>
            @endguest
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ url('/') }}" class="navbar-brand">
                <h1 class="text-primary display-6">SIKOSAN</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search text-primary"></i>
                    </button>
                    @auth
                        <a href="#" class="my-auto" style="text-transform: capitalize">
                            <i class="fas fa-user fa-2x me-2"></i>{{ Auth::user()->name }}
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>
