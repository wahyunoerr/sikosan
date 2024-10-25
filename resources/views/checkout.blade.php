@extends('layouts.landing.app', ['title' => 'Kamar Detail'])

@section('breadcrumb')
    <div class="container-fluid page-header py-5"
        style="background-image: url({{ asset('assets/assetsLanding/img/bg-hero.jpeg') }}); background-position: top center; opacity: 70%">
        <h1 class="text-center text-primary display-6">Kamar {{ $kamar->nomor }} | {{ $kamar->lantai }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Sikosan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">List Kamar</a></li>
            <li class="breadcrumb-item active text-white">Detail</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">

            @if ($errors->any())
                <div class="my-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    <i class="bi bi-exclamation-diamond-fill me-2"></i><strong>{{ $error }}</strong>
                                </li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="row g-4 mb-5">
                <div class="col-lg-12 col-xl-12">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="rounded">
                                <a href="#">
                                    @if ($images->isNotEmpty())
                                        <img src="{{ Storage::disk('public')->url('upload/image/' . $images->first()->nameImage) }}"
                                            class="rounded" alt="Image" id="main-image" />
                                    @else
                                        <img src="path/to/default/image.jpg" class="rounded" alt="Default Image"
                                            id="main-image" />
                                    @endif
                                </a>
                            </div>
                            <div class="d-flex justify-content-start gap-3 my-3">
                                <!-- start-looping -->
                                @foreach ($images as $image)
                                    <img src="{{ Storage::disk('public')->url('upload/image/' . $image->nameImage) }}"
                                        class="img-fluid rounded border small-image" alt="Image" width="100"
                                        style="cursor: pointer" />
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fw-bold mb-3">{{ $kamar->nomor }}</h3>
                                <h3 class="fw-bold mb-3">
                                    <span
                                        class="badge px-3 bg-{{ $kamar->status == 'Belum Dihuni' ? 'primary' : 'danger' }}">{{ $kamar->status }}</span>
                                </h3>
                            </div>
                            <p class="mb-3">Berada di Lantai : {{ $kamar->lantai }}</p>
                            <h5 class="fw-bold mb-3">Rp. {{ number_format($kamar->harga) }}</h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                            </div>
                            <div class="mb-4">
                                @auth
                                    <a href="#" class="btn border border-secondary rounded-pill px-5 text-primary"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-shopping-cart me-3"></i> Booking!
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Form Booking Kamar Kosan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="#" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row align-items-center g-3">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-secondary" role="alert">
                                                                    <h5 class="alert-heading">Detail Kamar Yang Akan
                                                                        Dibooking
                                                                    </h5>
                                                                    <ul>
                                                                        <li>Kode Kamar<span class="ms-2">:
                                                                                {{ $kamar->nomor }}</span></li>
                                                                        <li>Lantai Kamar<span class="ms-2">:
                                                                                {{ $kamar->lantai }}</span></li>
                                                                        <li>Harga Kamar<span class="ms-2">: Rp.
                                                                                {{ number_format($kamar->harga) }}</span>
                                                                        </li>
                                                                        <li>Fasilitas<span class="ms-2">:
                                                                                {{ $kamar->fasilitas }}</span></li>
                                                                    </ul>
                                                                    <hr>
                                                                    <p class="mb-0 text-center">
                                                                        <span class="badge bg-primary px-3 py-2">Status
                                                                            Kamar
                                                                            Saat
                                                                            Ini :
                                                                            <strong>{{ $kamar->status }}</strong></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="namaLengkapDisabled" class="form-label">Nama
                                                                    Lengkap
                                                                    Anda</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="bi bi-person-fill"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        name="namaLengkapDisabled"
                                                                        value="{{ Auth::user()->name }}"
                                                                        id="namaLengkapDisabled"
                                                                        placeholder="Nama Lengkap Anda"
                                                                        aria-label="Nama Lengkap Anda"
                                                                        aria-describedby="basic-addon1" disabled readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="hargaKamarDisabled" class="form-label">Harga
                                                                    Kamar
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">Rp.</span>
                                                                    <input type="text" class="form-control"
                                                                        name="hargaKamarDisabled"
                                                                        value="{{ number_format($kamar->harga) }}"
                                                                        id="hargaKamarDisabled"
                                                                        placeholder="Nama Lengkap Anda"
                                                                        aria-label="Nama Lengkap Anda"
                                                                        aria-describedby="basic-addon1" disabled readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="uploadBukti" class="form-label">Upload
                                                                    Bukti Pembayaran</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" type="file"
                                                                        id="uploadBukti" name="uploadBukti">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"><i
                                                                class="bi bi-x-circle-fill me-2"></i>Close</button>
                                                        <button type="sunmit" class="btn btn-primary"><i
                                                                class="bi bi-check-circle-fill me-2"></i>Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button type="button" onclick="window.location.href='{{ route('login') }}'"
                                        class="btn border border-secondary rounded-pill px-5 text-primary">
                                        <i class="fa fa-shopping-cart me-3"></i> Booking!
                                    </button>
                                @endauth
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">
                                        Fasilitas
                                    </button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">
                                        Reviews
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>
                                        {{ $kamar->fasilitas }}
                                    </p>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/assetsLanding/img/avatar.jpg') }}"
                                            class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px"
                                            alt="" />
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px">
                                                {{ now()->format('d F, Y') }}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Syukri Lubis</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                </div>
                                            </div>
                                            <p>
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat
                                                eligendi
                                                animi sapiente nisi veritatis quibusdam sed, cupiditate possimus facilis
                                                assumenda.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/assetsLanding/img/avatar.jpg') }}"
                                            class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px"
                                            alt="" />
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px">
                                                {{ now()->format('d F, Y') }}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Dimas Syahreza Siregar</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                </div>
                                            </div>
                                            <p class="text-dark">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat
                                                eligendi
                                                animi sapiente nisi veritatis quibusdam sed, cupiditate possimus facilis
                                                assumenda.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">
                                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor sit. Aliqu diam amet diam et eos labore. 3
                                    </p>
                                    <p class="mb-0">
                                        Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam
                                        et eos labore. Clita erat ipsum et lorem et sit
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const mainImage = document.getElementById("main-image");
        const smallImage = document.querySelectorAll(".small-image");

        mainImage.src = smallImage[0].src;

        smallImage.forEach((img) => {
            img.addEventListener("click", function() {
                mainImage.src = this.src;
            });
        });
    </script>
@endsection
