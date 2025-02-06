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
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #3b3b4f #1a1a2e;
        }

        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #1a1a2e;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background-color: #3b3b4f;
            border-radius: 10px;
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
                            <div class="rounded position-relative shadow-lg" style="width: 100%; height: auto;">
                                <img src="{{ $images->isNotEmpty() ? Storage::disk('public')->url('upload/image/' . $images->first()->nameImage) : 'path/to/default/image.jpg' }}"
                                    class="rounded" alt="Image" id="main-image"
                                    style="width: 100%; height: auto; cursor: pointer;" />
                                <span
                                    class="badge position-absolute top-0 start-0 m-2 px-3 bg-{{ $kamar && $kamar->status == 'Belum Dihuni' ? 'primary' : 'danger' }}">{{ $kamar->status ?? '' }}</span>
                            </div>
                            <div class="d-flex justify-content-start gap-3 my-3">
                                @foreach ($images as $image)
                                    <img src="{{ Storage::disk('public')->url('upload/image/' . $image->nameImage) }}"
                                        class="img-fluid rounded border small-image" alt="Image" width="100"
                                        height="100" style="cursor: pointer" />
                                @endforeach
                            </div>
                        </div>

                        <div id="imagePreviewOverlay"
                            class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                            style="z-index: 1050; background: rgba(0, 0, 0, 0.75);">
                            <button class="position-absolute top-50 start-0 translate-middle-y btn btn-secondary"
                                id="overlay-prev-image" style="z-index: 1;">&#10094;</button>
                            <img src="" class="rounded" alt="Image" id="overlay-main-image"
                                style="max-width: 90%; max-height: 90%;" />
                            <button class="position-absolute top-50 end-0 translate-middle-y btn btn-secondary"
                                id="overlay-next-image" style="z-index: 1;">&#10095;</button>
                            <button class="position-absolute top-0 end-0 m-3 btn btn-secondary" id="overlay-close"
                                style="z-index: 1;">&times;</button>
                        </div>

                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fw-bold">Nomor Kamar : {{ $kamar->nomor ?? '' }}</h3>
                            </div>
                            <p class="mb-3">Berada di Lantai : {{ $kamar->lantai ?? '' }}</p>
                            <p class="mb-3">Fasilitas : {{ $kamar->fasilitas ?? '' }}</p>
                            <p class="mb-3">alamat : {{ $kamar->alamat ?? '' }}</p>

                            <h5 class="fw-bold mb-3">Rp. {{ number_format($kamar->harga ?? 0) }}</h5>
                            <div class="d-flex mb-4">
                                @php
                                    $rating = $averageRating ?? 0;
                                    $fullStars = floor($rating);
                                @endphp
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $fullStars)
                                        <i class="fa fa-star text-warning"></i>
                                    @else
                                        <i class="fa fa-star text-black-50"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="mb-4">
                                @auth
                                    <a href="#" class="btn border border-secondary rounded-pill px-5 text-primary"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-shopping-cart me-3"></i> Booking!
                                    </a>

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
                                                                <label for="namaLengkapDisabled" class="form-label">Nama
                                                                    Lengkap
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
                                    @if ($reviews->isEmpty())
                                        <p>Belum ada review.</p>
                                    @else
                                        @foreach ($reviews as $review)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-2">
                                                        @php
                                                            $rating = $averageRating ?? 0;
                                                            $fullStars = floor($rating);
                                                        @endphp
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $fullStars)
                                                                <i class="fa fa-star text-warning"></i>
                                                            @else
                                                                <i class="fa fa-star text-black-50"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <p>{{ $review->review }}</p>
                                                    <small class="text-muted">
                                                        Reviewed by:
                                                        @if ($review->user_id == Auth::id())
                                                            Anda
                                                        @else
                                                            {{ DB::table('users')->where('id', $review->user_id)->value('name') }}
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-detail')
    <script>
        const mainImage = document.getElementById("main-image");
        const overlayMainImage = document.getElementById("overlay-main-image");
        const smallImages = document.querySelectorAll(".small-image");
        const prevButton = document.getElementById("overlay-prev-image");
        const nextButton = document.getElementById("overlay-next-image");
        const closeButton = document.getElementById("overlay-close");
        const imagePreviewOverlay = document.getElementById("imagePreviewOverlay");
        let currentIndex = 0;

        function updateOverlayImage(index) {
            overlayMainImage.src = smallImages[index].src;
        }

        mainImage.addEventListener("click", function() {
            imagePreviewOverlay.classList.remove("d-none");
            updateOverlayImage(currentIndex);
        });

        smallImages.forEach((img, index) => {
            img.addEventListener("click", function() {
                currentIndex = index;
                mainImage.src = img.src;
                updateOverlayImage(currentIndex);
            });
        });

        prevButton.addEventListener("click", function() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : smallImages.length - 1;
            updateOverlayImage(currentIndex);
        });

        nextButton.addEventListener("click", function() {
            currentIndex = (currentIndex < smallImages.length - 1) ? currentIndex + 1 : 0;
            updateOverlayImage(currentIndex);
        });

        closeButton.addEventListener("click", function() {
            imagePreviewOverlay.classList.add("d-none");
        });

        // Initialize overlay image
        updateOverlayImage(currentIndex);

        // Star rating click event
        const stars = document.querySelectorAll('.fa-star');
        const ratingModal = document.getElementById('ratingModal');
        const ratingStars = document.querySelectorAll('.rating-star');
        let selectedRating = 0;

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                    @if (!$userHasRated)
                        @auth
                        selectedRating = index + 1;
                        ratingModal.style.display = 'block';
                        updateRatingStars(selectedRating);
                        document.getElementById('ratingInput').value =
                            selectedRating; // Set the rating input value
                    @else
                        window.location.href = '{{ route('login') }}';
                    @endauth
                @endif
            });

        star.addEventListener('mouseover', () => {
            updateRatingStars(index + 1);
        });

        star.addEventListener('mouseout', () => {
            updateRatingStars(selectedRating);
        });
        });

        function updateRatingStars(rating) {
            ratingStars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-warning');
                    star.classList.remove('text-transparent');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-transparent');
                }
            });
        }

        // Close rating modal
        document.getElementById('ratingModalClose').addEventListener('click', () => {
            ratingModal.style.display = 'none';
        });

        // Submit rating
        document.getElementById('submitRating').addEventListener('click', () => {
            // Handle rating submission logic here
            ratingModal.style.display = 'none';
        });

        // Initialize overlay image
        updateOverlayImage(currentIndex);
    </script>

    <style>
        @media (min-width: 992px) {
            #imagePreviewOverlay {
                align-items: center !important;
            }
        }

        .rating-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .rating-star {
            cursor: pointer;
            font-size: 2rem;
        }

        .text-transparent {
            color: transparent;
            text-shadow: 0 0 0 #000;
        }
    </style>
@endpush

@php
    $userHasRated = $reviews->where('user_id', Auth::id())->isNotEmpty();
@endphp

<div id="ratingModal" class="rating-modal">
    <h5 class="mb-3">Add Your Rating and Review</h5>
    @if (!$userHasRated)
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
            <div class="d-flex mb-3">
                @for ($i = 0; $i < 5; $i++)
                    <i class="fa fa-star rating-star text-transparent"></i>
                @endfor
                <input type="hidden" name="rating" id="ratingInput">
            </div>
            <textarea class="form-control mb-3" name="review" rows="3" placeholder="Write your review here..."></textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" id="ratingModalClose" class="btn btn-secondary">Close</button>
        </form>
    @else
        <p>You have already submitted a review for this room.</p>
        <button type="button" id="ratingModalClose" class="btn btn-secondary">Close</button>
    @endif
</div>
