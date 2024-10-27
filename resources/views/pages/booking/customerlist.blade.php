@extends('layouts.landing.app', ['title' => 'Booking List'])

@section('content')
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">List Ruangan Kost</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <h3 class="text-primary display-5 my-3">My Booking List</h3>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive p-3">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nomor Kamar Dibooking</th>
                                            <th scope="col">Lantai Kamar Dibooking</th>
                                            <th scope="col">Harga Kamar Dibooking</th>
                                            <th scope="col">Bukti Pembayaran</th>
                                            <th scope="col">Status Booking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($booking as $b)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $b->nomor }}</td>
                                                <td>{{ $b->lantai }}</td>
                                                <td>Rp. {{ number_format($b->harga_kamar_booking) }}</td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-original-title="Lihat Bukti Booking"
                                                        data-bs-target="#viewBuktiModal-{{ $b->id }}">
                                                        <img src="{{ Storage::disk('public')->url('upload/bukti/' . $b->bukti_bayar) }}"
                                                            class="img-fluid rounded shadow-lg" alt="img-bukti"
                                                            width="50"></img>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($b->status == 'Menunggu')
                                                        <span
                                                            class="badge px-3 py-2 rounded-pill bg-info">{{ $b->status }}...</span>
                                                    @elseif ($b->status == 'Ditolak')
                                                        <span
                                                            class="badge px-3 py-2 rounded-pill bg-danger">{{ $b->status }}</span>
                                                    @else
                                                        <span
                                                            class="badge px-3 py-2 rounded-pill bg-success">{{ $b->status }}</span>
                                                    @endif
                                                </td>

                                                <div class="modal fade" id="viewBuktiModal-{{ $b->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="viewBuktiModal-{{ $b->id }}Label"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="viewBuktiModal-{{ $b->id }}Label">
                                                                    Bukti Pembayaran Booking</h5>
                                                                <button class="btn-close" type="button"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="img-fluid d-flex justify-content-center">
                                                                    <img src="{{ Storage::disk('public')->url('upload/bukti/' . $b->bukti_bayar) }}"
                                                                        alt="modal-image-bukti" width="300"
                                                                        class="shadow">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-success px-3" type="button"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td scope="row" colspan="6" class="text-center">Anda belum melakukan
                                                    booking apapun, <a href="{{ url('/') }}">Silahkan booking kamar
                                                        yang
                                                        anda
                                                        inginkan!</a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
