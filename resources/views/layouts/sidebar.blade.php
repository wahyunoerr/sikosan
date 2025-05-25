<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light"
                    src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a>
            <div class="back-btn"><i data-feather="grid"></i></div>
            <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle"
                    data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="index.html">
                <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="/home">
                            <i data-feather="home">
                            </i><span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-list"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i
                                data-feather="airplay"></i><span>Master Data</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/kamar">Kamar</a></li>
                            <li><a href="/rekening">Info Rekening</a></li>
                            <li><a href="/pengguna">Pengguna</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i
                                data-feather="list"></i><span>Booking Data</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/booking">Booking</a></li>
                            <li><a href="/transaksi">Transaksi</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list {{ request()->is('rating*') ? 'active' : '' }}">
                        <a class="sidebar-link sidebar-title" href="{{ route('rating.index') }}">
                            <i class="fa fa-star"></i> <span>Rating</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i
                                data-feather="log-out"></i><span>Checkout/Pindah</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/pindah">Data Checkout/Pindah</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ route('kamar.riwayat') }}">
                            <i class="fa fa-history"></i> <span>Riwayat Kamar</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ route('kamar.laporan.kosong') }}">
                            <i class="fa fa-bed"></i> <span>Laporan Kamar Kosong</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
