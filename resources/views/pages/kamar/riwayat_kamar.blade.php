@extends('layouts.app')
@section('title', 'List Kamar')
@section('content')
    <div class="container-fluid product-wrapper">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="{{ route('kamar.list') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> List Kamar</a>
                <form class="d-flex" method="GET" action="">
                    <input class="form-control me-2" type="search" name="q" placeholder="Cari kamar/nama penghuni..."
                        aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                </form>
            </div>
        </div>
        <div class="product-grid">
            <div class="product-wrapper-grid">
                @if (count($riwayat) > 0)
                    <div class="row">
                        @foreach ($riwayat as $r)
                            @php
                                $kamarData = isset($dataKamar[$r->kamar_lama_id])
                                    ? $dataKamar[$r->kamar_lama_id]
                                    : null;
                                $img =
                                    $kamarData && isset($gambarKamar[$r->kamar_lama_id][0])
                                        ? $gambarKamar[$r->kamar_lama_id][0]->nameImage
                                        : null;
                            @endphp
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="card">
                                    <div class="product-box">
                                        <div class="product-img">
                                            @if ($img)
                                                <img class="img-fluid" src="{{ asset('storage/upload/image/' . $img) }}"
                                                    alt="Kamar {{ $kamarData->nomor ?? '-' }}">
                                            @else
                                                <img class="img-fluid"
                                                    src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image">
                                            @endif
                                            <div class="product-hover">
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#detailKamarModal{{ $r->kamar_lama_id }}">Detail</button>
                                            </div>
                                        </div>
                                        <div class="product-details">
                                            <h4>Kamar {{ $kamarData->nomor ?? '-' }}</h4>
                                            <p>Penghuni: <span class="fw-bold">{{ $r->nama_customer }}</span></p>
                                            <p>Tanggal Booking:
                                                {{ $r->tanggal_booking ? date('d-m-Y', strtotime($r->tanggal_booking)) : '-' }}
                                            </p>
                                            <p>Tanggal Pindah:
                                                {{ $r->tanggal_pindah ? date('d-m-Y', strtotime($r->tanggal_pindah)) : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Detail Kamar -->
                            <div class="modal fade" id="detailKamarModal{{ $r->kamar_lama_id }}" tabindex="-1"
                                aria-labelledby="detailKamarModalLabel{{ $r->kamar_lama_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailKamarModalLabel{{ $r->kamar_lama_id }}">
                                                Detail
                                                Kamar {{ $kamarData->nomor ?? '-' }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if ($img)
                                                        <img class="img-fluid mb-3"
                                                            src="{{ asset('storage/upload/image/' . $img) }}"
                                                            alt="Kamar {{ $kamarData->nomor ?? '-' }}">
                                                    @else
                                                        <img class="img-fluid mb-3"
                                                            src="https://via.placeholder.com/300x200?text=No+Image"
                                                            alt="No Image">
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><strong>Nomor:</strong>
                                                            {{ $kamarData->nomor ?? '-' }}</li>
                                                        <li class="list-group-item"><strong>Penghuni:</strong>
                                                            {{ $r->nama_customer }}</li>
                                                        <li class="list-group-item"><strong>Tanggal Booking:</strong>
                                                            {{ $r->tanggal_booking ? date('d-m-Y', strtotime($r->tanggal_booking)) : '-' }}
                                                        </li>
                                                        <li class="list-group-item"><strong>Tanggal Pindah:</strong>
                                                            {{ $r->tanggal_pindah ? date('d-m-Y', strtotime($r->tanggal_pindah)) : '-' }}
                                                        </li>
                                                        <li class="list-group-item"><strong>Alasan:</strong>
                                                            {{ $r->alasan ?? '-' }}</li>
                                                        @if ($kamarData)
                                                            <li class="list-group-item"><strong>Lantai:</strong>
                                                                {{ $kamarData->lantai }}</li>
                                                            <li class="list-group-item"><strong>Status:</strong>
                                                                {{ $kamarData->status }}</li>
                                                            <li class="list-group-item"><strong>Fasilitas:</strong>
                                                                {{ $kamarData->fasilitas }}</li>
                                                            <li class="list-group-item"><strong>Alamat:</strong>
                                                                {{ $kamarData->alamat }}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">Tidak ada riwayat kamar.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
