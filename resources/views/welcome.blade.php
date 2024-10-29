@extends('layouts.landing.app', ['title' => 'Home'])

@section('breadcrumb')
    <div class="container-fluid page-header py-5"
        style="background-image: url({{ asset('assets/assetsLanding/img/bg-hero.jpeg') }}); background-position: top center; opacity: 70%">
        <h1 class="text-center text-primary display-6">List Ruangan Kos</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Sikosan</a></li>
            <li class="breadcrumb-item active text-white">List</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">List Ruangan Kost</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4 my-3 align-items-center">
                        <div class="col-xl-6">
                            <form action="{{ route('landing.index') }}" method="GET">
                                <div class="input-group w-50 d-flex">
                                    <input type="search" name="search" class="form-control p-3" placeholder="keywords"
                                        aria-describedby="search-icon-1" />
                                    <span id="search-icon-1" class="input-group-text p-3"><i
                                            class="fa fa-search"></i></span>
                                </div>
                            </form>

                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('landing.index') }}" class="btn btn-danger btn-lg px-4 rounded">
                                <i class="fa fa-times me-2"></i> Reset Search
                            </a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4 justify-content-start">
                                <!-- Start Looping -->
                                @forelse ($kamar as $k => $images)
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="rounded position-relative fruite-item">
                                            <div id="carousel-{{ $k }}" class="carousel slide carousel-fade">
                                                <div class="carousel-inner fruite-img">
                                                    @foreach ($images as $index => $image)
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">

                                                            <img src="{{ Storage::disk('public')->url('upload/image/' . $image->nameImage) }}"
                                                                class="d-block w-100 border border-secondary"
                                                                alt="Image for Room {{ $k }}" width="auto"
                                                                height="500" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carousel-{{ $k }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carousel-{{ $k }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5>Kode Kamar : {{ $images[0]->nomor }} | {{ $images[0]->lantai }}
                                                    </h5>
                                                    <h5><span
                                                            class="badge px-3 bg-{{ $images[0]->status == 'Belum Dihuni' ? 'primary' : 'danger' }}">{{ $images[0]->status }}</span>
                                                    </h5>
                                                </div>
                                                <p>{{ $images[0]->fasilitas }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.
                                                        {{ number_format($images[0]->harga) }}</p>
                                                    @if ($images[0]->status == 'Belum Dihuni')
                                                        <a href="{{ route('landing.getKamar', $images[0]->id) }}"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary">
                                                            <i class="fa fa-ticket-alt me-2 text-primary"></i> Booking
                                                            Sekarang!
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div
                                            class="rounded position-relative fruite-item border border-danger border-rounded px-4 py-2">
                                            <h3 class="display-3 text-danger text-center">Kamar Belum Ada🙏🏻.</h3>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
