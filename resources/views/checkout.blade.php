@extends('layouts.landing.app', ['title' => 'Kamar Detail'])

@section('breadcrumb')
    <div class="container-fluid page-header py-5"
        style="background-image: url({{ asset('assets/assetsLanding/img/bg-hero.jpeg') }}); background-position: top center; opacity: 70%">
        <h1 class="text-center text-primary display-6">Kamar {{ $kamar->nomor ?? '' }} | {{ $kamar->lantai ?? '' }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Sikosan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">List Kamar</a></li>
            <li class="breadcrumb-item active text-white">Detail</li>
        </ol>
    </div>
@endsection

@section('content')
    <style>
        .modal-body {
            max-height: 400px;
            /* Set max height as needed */
            overflow-y: auto;
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: #3b3b4f #1a1a2e;
            /* Custom scrollbar color for Firefox */
        }

        /* Custom scrollbar styling for WebKit browsers (e.g., Chrome, Safari) */
        .modal-body::-webkit-scrollbar {
            width: 6px;
            /* Width of the scrollbar */
        }

        .modal-body::-webkit-scrollbar-track {
            background: #1a1a2e;
            /* Background of the scrollbar track */
        }

        .modal-body::-webkit-scrollbar-thumb {
            background-color: #3b3b4f;
            /* Color of the scrollbar thumb */
            border-radius: 10px;
            /* Rounded edges for the thumb */
        }
    </style>

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
                                    <img src="{{ $images->isNotEmpty() ? Storage::disk('public')->url('upload/image/' . $images->first()->nameImage) : 'path/to/default/image.jpg' }}"
                                        class="rounded" alt="Image" id="main-image" />
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
                                <h3 class="fw-bold mb-3">{{ $kamar->nomor ?? '' }}</h3>
                                <h3 class="fw-bold mb-3">
                                    <span
                                        class="badge px-3 bg-{{ $kamar && $kamar->status == 'Belum Dihuni' ? 'primary' : 'danger' }}">{{ $kamar->status ?? '' }}</span>
                                </h3>
                            </div>
                            <p class="mb-3">Berada di Lantai : {{ $kamar->lantai ?? '' }}</p>
                            <h5 class="fw-bold mb-3">Rp. {{ number_format($kamar->harga ?? 0) }}</h5>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Form Booking Kamar Kosan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('booking.save') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row align-items-center g-3">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-secondary" role="alert">
                                                                    <h5 class="alert-heading">Detail Kamar Yang Akan Dibooking
                                                                    </h5>
                                                                    <div class="row align-items-center">
                                                                        <div class="col-md-7">
                                                                            <ul>
                                                                                <li>Kode Kamar<span class="ms-2">:
                                                                                        <strong>{{ $kamar->nomor ?? '' }}</strong></span>
                                                                                </li>
                                                                                <li>Lantai Kamar<span class="ms-2">:
                                                                                        <strong>{{ $kamar->lantai ?? '' }}</strong></span>
                                                                                </li>
                                                                                <li>Harga Kamar<span class="ms-2">: Rp.
                                                                                        <strong>{{ number_format($kamar->harga ?? 0) }}</strong></span>
                                                                                </li>
                                                                                <li>Fasilitas<span class="ms-2">:
                                                                                        <strong>{{ $kamar->fasilitas ?? '' }}</strong></span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="col-md-5">
                                                                            @foreach ($rekening as $rkn)
                                                                                <ul>
                                                                                    <li>A/N Rekening :<span
                                                                                            class="ms-2"><strong>{{ $rkn->namaRekening }}</strong></span>
                                                                                    </li>
                                                                                    <li>Nomor Rekening :<span class="ms-2">
                                                                                            <strong>{{ $rkn->nomorRekening }}</strong></span>
                                                                                    </li>
                                                                                </ul>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <p class="mb-0 text-center">
                                                                        <span class="badge bg-primary px-3 py-2">Status Kamar
                                                                            Saat Ini :
                                                                            <strong>{{ $kamar->status ?? '' }}</strong></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="namaLengkapDisabled" class="form-label">Nama Lengkap
                                                                    Anda</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="bi bi-person-fill"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        name="namaLengkapDisabled"
                                                                        value="{{ Auth::user()->name ?? '' }}"
                                                                        id="namaLengkapDisabled"
                                                                        placeholder="Nama Lengkap Anda"
                                                                        aria-label="Nama Lengkap Anda" disabled readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="hargaKamarDisabled" class="form-label">Harga
                                                                    Kamar</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">Rp.</span>
                                                                    <input type="text" class="form-control"
                                                                        name="hargaKamarDisabled"
                                                                        value="{{ number_format($kamar->harga ?? 0) }}"
                                                                        id="hargaKamarDisabled" placeholder="Harga Kamar"
                                                                        aria-label="Harga Kamar" disabled readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="uploadBukti" class="form-label">Upload Bukti
                                                                    Pembayaran</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" type="file"
                                                                        id="uploadBukti" name="uploadBukti">
                                                                </div>
                                                            </div>
                                                            <input class="d-none" type="text" id="kamarID"
                                                                name="kamarID" value="{{ $kamar->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"><i
                                                                class="bi bi-x-circle-fill me-2"></i>Close</button>
                                                        <button type="submit" class="btn btn-primary"><i
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
                                    <h4 class="fw-bold mb-3">Fasilitas</h4>
                                    <p>{{ $kamar->fasilitas ?? '' }}</p>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <h4 class="fw-bold mb-3">Reviews</h4>
                                    <p>Belum ada review.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
