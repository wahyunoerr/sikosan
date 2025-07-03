@extends('layouts.app')
@section('title', 'List Kamar')
@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-primary">
                    <strong>Total Kamar:</strong> {{ $kamar->count() }} |
                    <strong>Kamar Tersedia:</strong> {{ $kamar->where('status', 'Belum Dihuni')->count() }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="{{ route('kamar.riwayat') }}" class="btn btn-info"><i class="fa fa-history"></i> Riwayat Kamar
                </a>
                <form class="d-flex" method="GET" action="">
                    <input class="form-control me-2" type="search" name="q" placeholder="Cari kamar/nama penghuni..."
                        aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                </form>
            </div>
        </div>
        <div class="product-grid">
            <div class="product-wrapper-grid">
                <div class="row">
                    @foreach ($kamar as $k)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="product-box">
                                    <div class="product-img">
                                        @php
                                            $img = $gambarKamar[$k->id][0]->nameImage ?? null;
                                        @endphp
                                        @if ($img)
                                            <img class="img-fluid" src="{{ asset('storage/upload/image/' . $img) }}"
                                                alt="Kamar {{ $k->nomor }}">
                                        @else
                                            <img class="img-fluid" src="https://via.placeholder.com/300x200?text=No+Image"
                                                alt="No Image">
                                        @endif
                                    </div>
                                    <div class="product-details">
                                        <h4>Kamar {{ $k->nomor }}</h4>
                                        <p>Status:
                                            @if ($k->status === 'Sudah Dihuni')
                                                <span class="badge bg-success">Tidak Tersedia</span>
                                            @else
                                                <span class="badge bg-secondary">Tersedia</span>
                                            @endif
                                        </p>
                                        <p>Penghuni Sekarang:
                                            @if ($k->status === 'Sudah Dihuni' && isset($penghuniAktif[$k->id]))
                                                <span class="fw-bold">{{ $penghuniAktif[$k->id]->nama_customer }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
